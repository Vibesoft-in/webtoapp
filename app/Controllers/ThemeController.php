<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Theme;
use App\Services\ThemeEngine\ThemeManager;
use App\Services\ThemeEngine\ThemeConfiguration;

class ThemeController extends Controller
{
    private Theme $themeModel;
    private ThemeManager $themeManager;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->themeModel = new Theme();
        $this->themeManager = new ThemeManager();
    }

    /**
     * Theme Marketplace Catalog
     */
    public function index(): void
    {
        $themes = $this->themeManager->getAllThemes();
        $categories = $this->themeManager->getCategories();
        $selectedThemeId = Session::get('selected_theme_id');

        $this->render('themes.index', [
            'title' => 'App Themes | AppifyHub',
            'metaDescription' => 'Explore professionally designed mobile app themes for ecommerce, fashion, restaurants, services and businesses. Preview each theme live and choose the right design for your app.',
            'themes' => $themes,
            'categories' => $categories,
            'selectedThemeId' => $selectedThemeId,
        ], 'main');
    }

    /**
     * Dedicated Theme Details Page
     */
    public function details(array $params = []): void
    {
        $slug = $params['slug'] ?? $this->request->input('slug', '');
        $theme = $this->themeManager->getThemeBySlug($slug);

        if (!$theme) {
            $this->redirect(url('/themes'));
            return;
        }

        $allThemes = $this->themeManager->getAllThemes();

        $this->render('themes.details', [
            'title' => $theme['name'] . ' Theme | AppifyHub',
            'metaDescription' => 'Explore the ' . $theme['name'] . ' mobile app theme. Features, interactive preview, and pricing for your app.',
            'theme' => $theme,
            'allThemes' => $allThemes,
            'selectedThemeId' => Session::get('selected_theme_id'),
        ], 'main');
    }

    /**
     * Interactive Mobile App Live Demo Simulation
     */
    public function demo(array $params = []): void
    {
        $slug = $params['slug'] ?? $this->request->input('slug', 'modern-minimalist');
        $theme = $this->themeManager->getThemeBySlug($slug);

        if (!$theme) {
            $this->redirect(url('/themes'));
            return;
        }

        $allThemes = $this->themeManager->getAllThemes();
        $demoData = ThemeConfiguration::getThemeDemoContent($slug);

        $this->render('themes.demo', [
            'title' => 'Live Demo: ' . $theme['name'] . ' | AppifyHub',
            'theme' => $theme,
            'demoData' => $demoData,
            'allThemes' => $allThemes,
            'selectedThemeId' => Session::get('selected_theme_id'),
        ], 'main');
    }

    /**
     * Preview alias (routes to live demo)
     */
    public function preview(array $params = []): void
    {
        $slug = $params['slug'] ?? $this->request->input('slug', 'modern-minimalist');
        $this->demo(['slug' => $slug]);
    }

    /**
     * Select Theme for Project / Order
     */
    public function select(): void
    {
        $themeId = (int)$this->request->input('theme_id');
        $theme = $this->themeModel->find($themeId);

        if ($theme) {
            Session::set('selected_theme_id', $themeId);
            Session::set('selected_theme_slug', $theme['slug']);
            Session::set('selected_theme_name', $theme['name']);
            Session::set('selected_theme_price', (float)$theme['price']);

            Session::flash('success', $theme['name'] . ' selected ✓');
        }

        if ($this->request->isJson()) {
            $this->response->json([
                'success' => true,
                'message' => ($theme['name'] ?? 'Theme') . ' selected ✓',
                'redirect' => url('/addons'),
                'theme' => $theme
            ])->send();
            return;
        }

        $this->redirect(url('/addons'));
    }
}
