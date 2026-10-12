<?php

declare(strict_types=1);

namespace App\Core;

class Validator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function required(string $field, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value === null || trim((string)$value) === '') {
            $this->addError($field, $message ?? ucfirst($field) . ' is required.');
        }
        return $this;
    }

    public function email(string $field, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $message ?? ucfirst($field) . ' must be a valid email address.');
        }
        return $this;
    }

    public function url(string $field, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            $this->addError($field, $message ?? ucfirst($field) . ' must be a valid URL.');
        }
        return $this;
    }

    public function min(string $field, int $min, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && strlen((string)$value) < $min) {
            $this->addError($field, $message ?? ucfirst($field) . " must be at least {$min} characters.");
        }
        return $this;
    }

    public function max(string $field, int $max, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && strlen((string)$value) > $max) {
            $this->addError($field, $message ?? ucfirst($field) . " may not exceed {$max} characters.");
        }
        return $this;
    }

    public function numeric(string $field, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && !is_numeric($value)) {
            $this->addError($field, $message ?? ucfirst($field) . ' must be numeric.');
        }
        return $this;
    }

    public function in(string $field, array $allowed, ?string $message = null): self
    {
        $value = $this->data[$field] ?? null;
        if ($value && !in_array($value, $allowed, true)) {
            $this->addError($field, $message ?? ucfirst($field) . ' contains an invalid selection.');
        }
        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function validate(array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {
            $rulesList = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
            $value = $this->data[$field] ?? null;

            foreach ($rulesList as $rule) {
                $params = [];
                if (str_contains($rule, ':')) {
                    [$rule, $paramStr] = explode(':', $rule, 2);
                    $params = explode(',', $paramStr);
                }

                $this->applyRule($field, $value, $rule, $params);
            }
        }

        return empty($this->errors);
    }

    private function applyRule(string $field, mixed $value, string $rule, array $params): void
    {
        switch ($rule) {
            case 'required':
                if ($value === null || trim((string)$value) === '') {
                    $this->addError($field, ucfirst($field) . ' is required.');
                }
                break;
            case 'email':
                if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, ucfirst($field) . ' must be a valid email address.');
                }
                break;
            case 'url':
                if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->addError($field, ucfirst($field) . ' must be a valid URL.');
                }
                break;
            case 'min':
                $min = (int)($params[0] ?? 0);
                if ($value && strlen((string)$value) < $min) {
                    $this->addError($field, ucfirst($field) . " must be at least {$min} characters.");
                }
                break;
            case 'max':
                $max = (int)($params[0] ?? 0);
                if ($value && strlen((string)$value) > $max) {
                    $this->addError($field, ucfirst($field) . " may not exceed {$max} characters.");
                }
                break;
            case 'numeric':
                if ($value && !is_numeric($value)) {
                    $this->addError($field, ucfirst($field) . ' must be numeric.');
                }
                break;
        }
    }

    private function addError(string $field, string $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = $message;
        }
    }

    public function errors(): array
    {
        return $this->errors;
    }
}