<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\App;
use App\Models\AppFeature;
use App\Models\Build;
use App\Services\AppBuilder\BuildManager;

class AppController extends Controller
{
    private App $appModel;
    private AppFeature $featureModel;
    private Build $buildModel;
    private BuildManager $buildManager;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->appModel = new App();
        $this->featureModel = new AppFeature();
        $this->buildModel = new Build();
        $this->buildManager = new BuildManager();
    }

    public function updateSettings(): void
    {
        $userId = (int)Session::get('user_id');
        $appId = (int)$this->request->input('app_id');

        $app = $this->appModel->find($appId);
        if (!$app || (int)$app['user_id'] !== $userId) {
            Session::flash('error', 'App not found or permission denied.');
            $this->redirect(url('/dashboard/app-settings'));
            return;
        }

        $appName = trim((string)$this->request->input('app_name', $app['app_name']));
        $primaryColor = trim((string)$this->request->input('primary_color', $app['primary_color']));
        $secondaryColor = trim((string)$this->request->input('secondary_color', $app['secondary_color']));

        $this->appModel->update($appId, [
            'app_name' => $appName,
            'primary_color' => $primaryColor,
            'secondary_color' => $secondaryColor,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'App settings updated successfully.');
        $this->redirect(url('/dashboard/app-settings'));
    }

    public function toggleFeature(): void
    {
        $userId = (int)Session::get('user_id');
        $featureId = (int)$this->request->input('feature_id');
        $isEnabled = (int)$this->request->input('is_enabled', 1);

        $feature = $this->featureModel->find($featureId);
        if ($feature) {
            $app = $this->appModel->find((int)$feature['app_id']);
            if ($app && (int)$app['user_id'] === $userId) {
                $this->featureModel->update($featureId, [
                    'is_enabled' => $isEnabled,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        if ($this->request->isJson()) {
            $this->json(['success' => true]);
            return;
        }

        $this->redirect(url('/dashboard/features'));
    }

    public function triggerBuild(): void
    {
        $userId = (int)Session::get('user_id');
        $appId = (int)$this->request->input('app_id');
        $platform = (string)$this->request->input('platform', 'android');

        $app = $this->appModel->find($appId);
        if (!$app || (int)$app['user_id'] !== $userId) {
            Session::flash('error', 'App not found or permission denied.');
            $this->redirect(url('/dashboard/builds'));
            return;
        }

        // Count previous builds for versioning
        $existingBuilds = $this->buildModel->getByAppId($appId);
        $buildNumber = count($existingBuilds) + 1;

        // Queue build in build manager architecture
        $buildJob = $this->buildManager->queueBuild($appId, $platform);

        $this->buildModel->create([
            'app_id' => $appId,
            'build_number' => $buildNumber,
            'platform' => in_array($platform, ['android', 'ios', 'both']) ? $platform : 'android',
            'version' => $app['version'] ?? '1.0.0',
            'status' => 'queued',
            'started_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        Session::flash('success', 'Build job #' . $buildNumber . ' queued successfully.');
        $this->redirect(url('/dashboard/builds'));
    }
}
