<?php declare(strict_types=1);

namespace App\Service;

/**
 * Class JsonSerializerException
 * @package XF\Utils\Json
 */
class JsonSerializerException extends \Exception
{
    private const SERIALIZATION_ERROR_CODE                 = 10001;
    private const DESERIALIZATION_ERROR_CODE               = 10002;
    private const INVALID_OPTIONS_TYPE_ERROR_CODE          = 10003;
    private const INVALID_RECURSION_DEPTH_ERROR_CODE       = 10004;
    private const INVALID_PAYLOAD_TYPE_ERROR_CODE          = 10005;
    private const INVALID_ASSOCIATIVE_FLAG_TYPE_ERROR_CODE = 10006;

    /**
     * @param string $message
     *
     * @return static
     */
    public static function serializationError($message)
    {
        return new static(
            sprintf('Unable to serialize to JSON, error: %s', $message),
            static::SERIALIZATION_ERROR_CODE
        );
    }

    /**
     * @param string $payload
     * @param string $message
     *
     * @return static
     */
    public static function deserializationError($payload, $message)
    {
        return new static(
            sprintf('Unable to deserialize JSON, payload: %s, error: %s', $payload, $message),
            static::DESERIALIZATION_ERROR_CODE
        );
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public static function invalidOptionsType($type)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new static(
            sprintf('Integer options value is expected, given: %s', $type),
            static::INVALID_OPTIONS_TYPE_ERROR_CODE
        );
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public static function invalidRecursionDepth($type)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new static(
            sprintf(
                'Recursion depth is expected to be numeric value between 1 and %s, given: %s',
                JsonSerializer::MAX_RECURSION_DEPTH,
                $type
            ),
            static::INVALID_RECURSION_DEPTH_ERROR_CODE
        );
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public static function invalidPayloadType($type)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new static(
            sprintf('String payload is expected, given: %s', $type),
            static::INVALID_PAYLOAD_TYPE_ERROR_CODE
        );
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public static function invalidAssociativeFlag($type)
    {
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new static(
            sprintf('Boolean associative flag is expected, given: %s', $type),
            static::INVALID_ASSOCIATIVE_FLAG_TYPE_ERROR_CODE
        );
    }
}