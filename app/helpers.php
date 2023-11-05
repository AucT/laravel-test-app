<?php

function getAvatarPath(?string $avatar): string
{
    return $avatar ? asset("storage/avatars/$avatar") : config('misc.avatar.default');
}
