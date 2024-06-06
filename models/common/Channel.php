<?php

namespace tthook\models\common;

final class Channel extends ModelJson
{
    /**
     * @var string|null
     */
    public ?string $id;
    
    /**
     * @var string|null
     */
    public ?string $name;
    
    /**
     * @var string|null
     */
    public ?string $type;

}
