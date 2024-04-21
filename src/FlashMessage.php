<?php

namespace Bolero\Plugins\FlashMessage;

use Bolero\Framework\Session\Session;
use Bolero\Plugins\FlashMessage\Enums\FlashType;
use Exception;

class FlashMessage implements FlashMessageInterface
{
    private const FLASH_KEY = 'flash';
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
        $id = $this->session->start();
    }

    /**
     * @throws Exception
     */
    public function getInfo(): array
    {
        return $this->get(FlashType::Info);
    }

    public function get(FlashType $type): array
    {
        $flashes = $this->session->read(self::FLASH_KEY) ?? [];
        if (isset($flashes[$type->name])) {
            $messages = $flashes[$type->name];
            unset($flashes[$type->name]);
            $this->session->write(self::FLASH_KEY, $flashes);

            return $messages;
        }

        return [];
    }

    public function getError(): array
    {
        return $this->get(FlashType::Error);
    }

    public function getSuccess(): array
    {
        return $this->get(FlashType::Success);
    }

    public function getWarning(): array
    {
        return $this->get(FlashType::Warning);
    }

    public function setInfo(string $message, ...$params): void
    {
        $this->set(FlashType::Info, $message, ...$params);
    }

    public function set(FlashType $type, string $message, ...$params): void
    {
        $message = sprintf($message, ...$params);
        $flashes = $this->session->read(self::FLASH_KEY) ?? [];
        $flashes[$type->name][] = $message;

        $this->session->write(self::FLASH_KEY, $flashes);
    }

    public function setError(string $message, ...$params): void
    {
        $this->set(FlashType::Error, $message, ...$params);
    }

    public function setSuccess(string $message, ...$params): void
    {
        $this->set(FlashType::Success, $message, ...$params);
    }

    public function setWarning(string $message, ...$params): void
    {
        $this->set(FlashType::Warning, $message, ...$params);
    }

    public function hasInfo(): bool
    {
        return $this->has(FlashType::Info);
    }

    public function has(FlashType $type): bool
    {
        if ($this->session->has(self::FLASH_KEY)) {
            $flashes = $this->session->read(self::FLASH_KEY);

            return isset($flashes[$type->name]);
        }

        return false;
    }

    public function hasError(): bool
    {
        return $this->has(FlashType::Error);
    }

    public function hasSuccess(): bool
    {
        return $this->has(FlashType::Success);
    }

    public function hasWarning(): bool
    {
        return $this->has(FlashType::Warning);
    }

    public function clear(): void
    {
        $this->session->remove(self::FLASH_KEY);
    }
}
