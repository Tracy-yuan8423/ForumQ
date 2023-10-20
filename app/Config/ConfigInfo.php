<?php

/*
 * Fresns (https://fresns.org)
 * Copyright (C) 2021-Present Jevan Tang
 * Released under the Apache-2.0 License.
 */

namespace Plugins\ForumQ\Config;

class ConfigInfo
{
    const NAMESPACE = 'ForumQ';

    const ROUTE_NAME = 'forumq';

    const ITEMS = [
        [
            'item_key' => 'forumq_loading',
            'item_value' => 'true',
            'item_type' => 'boolean', // number, string, boolean, array, object, file, plugin, plugins
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'forumq_quick_publish',
            'item_value' => 'true',
            'item_type' => 'boolean',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'forumq_notifications',
            'item_value' => '["systems","recommends","likes","dislikes","follows","blocks","mentions","comments","quotes"]',
            'item_type' => 'array',
            'item_tag' => 'themes',
        ],
    ];
}
