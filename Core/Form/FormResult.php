<?php

namespace Core\Form;

use Core\Form\FormError;

class FormResult
{
    private array $form_error = [];
    private string $success_message;

    public function getSuccessMessage(): string
    {
        return $this->success_message;
    }

    public function getFormError(): array
    {
        return $this->form_error;
    }

    public function getError(): array
    {
        return $this->form_error;
    }

    public function __construct(string $success_message = "")
    {
        $this->success_message = $success_message;
    }

    public function addError(FormError $error): void
    {
        $this->form_error[] = $error;
    }

    public function hasError(): bool
    {
        return !empty($this->form_error);
    }
}