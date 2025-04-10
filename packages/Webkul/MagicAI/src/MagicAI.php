<?php

namespace Webkul\MagicAI;

use Webkul\MagicAI\Services\Gemini;
use Webkul\MagicAI\Services\GroqAI;
use Webkul\MagicAI\Services\Ollama;
use Webkul\MagicAI\Services\OpenAI;

class MagicAI
{
    /**
     * LLM model.
     */
    protected string $model;

    /**
     * LLM agent.
     */
    protected string $agent;

    /**
     * Stream Response.
     */
    protected bool $stream = false;

    /**
     * Raw Response.
     */
    protected bool $raw = true;

    /**
     * Raw Response.
     */
    protected float $temperature = 0.7;

    /**
     * LLM prompt text.
     */
    protected string $prompt;

    /**
     * Set LLM model
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set LLM agent
     */
    public function setAgent(string $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Set stream response.
     */
    public function setStream(bool $stream): self
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Set response raw.
     */
    public function setRaw(bool $raw): self
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * Set LLM prompt text.
     */
    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Set LLM prompt text.
     */
    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * Set LLM prompt text.
     */
    public function ask(): string
    {
        return $this->getModelInstance()->ask();
    }

    /**
     * Generate Images
     */
    public function images(array $options): array
    {
        return $this->getModelInstance()->images($options);
    }

    /**
     * Get LLM model instance.
     */
    public function getModelInstance(): OpenAI|Ollama|Gemini|GroqAI
    {
        if (in_array($this->model, ['gpt-4-turbo', 'gpt-4o', 'gpt-4o-mini', 'dall-e-2', 'dall-e-3'])) {
            return new OpenAI(
                $this->model,
                $this->prompt,
                $this->temperature,
                $this->stream,
            );
        }

        if (in_array($this->model, ['llama3-8b-8192'])) {
            return new GroqAI(
                $this->model,
                $this->prompt,
                $this->temperature,
                $this->stream,
            );
        }

        if (in_array($this->model, ['gemini-2.0-flash'])) {
            return new Gemini(
                $this->model,
                $this->prompt,
                $this->stream,
                $this->raw,
            );
        }

        return new Ollama(
            $this->model,
            $this->prompt,
            $this->temperature,
            $this->stream,
            $this->raw,
        );
    }
}
