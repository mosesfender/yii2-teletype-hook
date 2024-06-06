<?php

namespace tthook\models\common;

final class Client extends ModelJson
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
    public ?string $avatar;
    
    /**
     * @var string|null
     */
    public ?string $phone;
}
