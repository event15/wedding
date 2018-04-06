<?php declare(strict_types=1);

namespace App\Service;

/**
 * Class JsonSerializer
 * @package XF\Utils\Json
 */
class JsonSerializer
{
    public const MAX_RECURSION_DEPTH = 512;

    /**
     * @param mixed $payload
     * @param int   $options
     * @param int   $recursionDepth
     *
     * @return string
     * @throws JsonSerializerException
     */
    public static function serialize(
        $payload,
        $options = 0,
        $recursionDepth = self::MAX_RECURSION_DEPTH
    ): string {
        static::assertOptions($options);
        static::assertRecursionDepth($recursionDepth);

        $serializedJsonPayload = json_encode($payload, $options, $recursionDepth);

        if (static::errorOccurred()) {
            throw JsonSerializerException::serializationError(static::getLastErrorMessage());
        }

        return $serializedJsonPayload;
    }

    /**
     * @param int $options
     *
     * @throws JsonSerializerException
     */
    private static function assertOptions($options): void
    {
        if (!is_int($options)) {
            throw JsonSerializerException::invalidOptionsType(gettype($options));
        }
    }

    /**
     * @param int $recursionDepth
     *
     * @throws JsonSerializerException
     */
    private static function assertRecursionDepth($recursionDepth): void
    {
        if (!is_int($recursionDepth) || $recursionDepth <= 0 || $recursionDepth > static::MAX_RECURSION_DEPTH) {
            throw JsonSerializerException::invalidRecursionDepth(gettype($recursionDepth));
        }
    }

    /**
     * @return bool
     */
    private static function errorOccurred(): bool
    {
        return json_last_error() !== JSON_ERROR_NONE;
    }

    /**
     * @return string
     */
    private static function getLastErrorMessage(): string
    {
        return json_last_error_msg();
    }

    /** @noinspection MoreThanThreeArgumentsInspection
     *
     * @param string $serializedJsonPayload
     * @param bool   $associative
     * @param int    $options
     * @param int    $recursionDepth
     *
     * @return mixed
     * @throws JsonSerializerException
     */
    public static function deserialize(
        $serializedJsonPayload,
        $associative = true,
        $options = 0,
        $recursionDepth = self::MAX_RECURSION_DEPTH
    ) {
        static::assertSerializedJsonPayload($serializedJsonPayload);
        static::assertAssociative($associative);
        static::assertOptions($options);
        static::assertRecursionDepth($recursionDepth);

        $deserializedPayload = json_decode($serializedJsonPayload, $associative, $recursionDepth, $options);

        if (static::errorOccurred()) {
            throw JsonSerializerException::deserializationError(
                $serializedJsonPayload,
                static::getLastErrorMessage()
            );
        }
        // TODO usuniecie po wdrozeniu php7 GRARCH-839
        if ('' === $serializedJsonPayload) {
            throw JsonSerializerException::deserializationError(
                $serializedJsonPayload,
                'Syntax Error - empty string is not valid JSON.'
            );
        }

        return $deserializedPayload;
    }

    /**
     * @param string $serializedJsonPayload
     *
     * @throws JsonSerializerException
     */
    private static function assertSerializedJsonPayload($serializedJsonPayload): void
    {
        if (!is_string($serializedJsonPayload)) {
            throw JsonSerializerException::invalidPayloadType(gettype($serializedJsonPayload));
        }
    }

    /**
     * @param bool $associative
     *
     * @throws JsonSerializerException
     */
    private static function assertAssociative($associative): void
    {
        if (!is_bool($associative)) {
            throw JsonSerializerException::invalidAssociativeFlag(gettype($associative));
        }
    }
}