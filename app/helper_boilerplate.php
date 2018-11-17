<?php

if (!function_exists('translateUrl')) {
    function translateUrl($route = '')
    {
        return trans("route." . ($route ? (string)$route : \Request::route()->getName()));
    }
}

if (!function_exists('getFirstNameLastname')) {
    function getFirstNameLastname()
    {
        return \Sentinel::check()->first_name . ' ' . \Sentinel::check()->last_name;
    }
}

if (!function_exists('isNullAndEmpty')) {
    function isNullAndEmpty($string)
    {
        return empty($string) && is_null($string);
    }
}

if (!function_exists('transformToOptionHTML')) {
    function transformToOptionHTML($arrays)
    {
        $result = '';
        foreach ($arrays as $key => $value) {
            $result .= "<option value='{$key}'>$value</option>";
        }
        return $result;
    }
}

if (!function_exists('getSidebar')) {
    function getSidebar()
    {
        $menu = new App\Models\Menu;
        // $menuUser = \Sentinel::check()->roles()->first()->getAttributes()['permissions'];
        $data = $menu->where('is_parent', 1);
        $data = $data->get();
        $data->transform(function ($item, $key) use ($menu) {
            $item->child = $menu->where('parent_id', $item->id)->get();
            return $item;
        });
        return $data;
    }
}
if (!function_exists('getListIcon')) {
    function getListIcon()
    {
        return [
            'fa-adjust', 'fa-asterisk', 'fa-ban-circle', 'fa-bar-chart', 'fa-barcode', 'fa-beaker', 'fa-bell', 'fa-bolt', 'fa-book', 'fa-bookmark', 'fa-bookmark-empty', 'fa-briefcase', 'fa-bullhorn', 'fa-calendar', 'fa-camera', 'fa-camera-retro', 'fa-certificate', 'fa-check', 'fa-check-empty', 'fa-cloud', 'fa-cog', 'fa-cogs', 'fa-comment', 'fa-comment-alt', 'fa-comments', 'fa-comments-alt', 'fa-credit-card', 'fa-dashboard', 'fa-download', 'fa-download-alt', 'fa-edit', 'fa-envelope', 'fa-envelope-alt', 'fa-exclamation-sign', 'fa-external-link', 'fa-eye-close', 'fa-eye-open', 'fa-facetime-video', 'fa-film', 'fa-filter', 'fa-fire', 'fa-flag', 'fa-folder-close', 'fa-folder-open', 'fa-gift', 'fa-glass', 'fa-globe', 'fa-group', 'fa-hdd', 'fa-headphones', 'fa-heart', 'fa-heart-empty', 'fa-home', 'fa-inbox', 'fa-info-sign', 'fa-key', 'fa-leaf', 'fa-legal', 'fa-lemon', 'fa-lock', 'fa-unlock', 'fa-magic', 'fa-magnet', 'fa-map-marker', 'fa-minus', 'fa-minus-sign', 'fa-money', 'fa-move', 'fa-music', 'fa-off', 'fa-ok', 'fa-ok-circle', 'fa-ok-sign', 'fa-pencil', 'fa-picture', 'fa-plane', 'fa-plus', 'fa-plus-sign', 'fa-print', 'fa-pushpin', 'fa-qrcode', 'fa-question-sign', 'fa-random', 'fa-refresh', 'fa-remove', 'fa-remove-circle', 'fa-remove-sign', 'fa-reorder', 'fa-resize-horizontal', 'fa-resize-vertical', 'fa-retweet', 'fa-road', 'fa-rss', 'fa-screenshot', 'fa-search', 'fa-share', 'fa-share-alt', 'fa-shopping-cart', 'fa-signal', 'fa-signin', 'fa-signout', 'fa-sitemap', 'fa-sort', 'fa-sort-down', 'fa-sort-up', 'fa-star', 'fa-star-empty', 'fa-star-half', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-thumbs-down', 'fa-thumbs-up', 'fa-time', 'fa-tint', 'fa-trash', 'fa-trophy', 'fa-truck', 'fa-umbrella', 'fa-upload', 'fa-upload-alt', 'fa-user', 'fa-user-md', 'fa-volume-off', 'fa-volume-down', 'fa-volume-up', 'fa-warning-sign', 'fa-wrench', 'fa-zoom-in', 'fa-zoom-out', 'fa-file', 'fa-cut', 'fa-copy', 'fa-paste', 'fa-save', 'fa-undo', 'fa-repeat', 'fa-paper-clip', 'fa-text-height', 'fa-text-width', 'fa-align-left', 'fa-align-center', 'fa-align-right', 'fa-align-justify', 'fa-indent-left', 'fa-indent-right', 'fa-font', 'fa-bold', 'fa-italic', 'fa-strikethrough', 'fa-underline', 'fa-link', 'fa-columns', 'fa-table', 'fa-th-large', 'fa-th', 'fa-th-list', 'fa-list', 'fa-list-ol', 'fa-list-ul', 'fa-list-alt', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-chevron-down', 'fa-circle-arrow-down', 'fa-circle-arrow-left', 'fa-circle-arrow-right', 'fa-circle-arrow-up', 'fa-chevron-left', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-up', 'fa-chevron-right', 'fa-hand-down', 'fa-hand-left', 'fa-hand-right', 'fa-hand-up', 'fa-chevron-up', 'fa-play-circle', 'fa-play', 'fa-pause', 'fa-stop', 'fa-step-backward', 'fa-fast-backward', 'fa-backward', 'fa-forward', 'fa-fast-forward', 'fa-step-forward', 'fa-eject', 'fa-fullscreen', 'fa-resize-full', 'fa-resize-small', 'fa-phone', 'fa-phone-sign', 'fa-facebook', 'fa-facebook-sign', 'fa-twitter', 'fa-twitter-sign', 'fa-github', 'fa-github-sign', 'fa-linkedin', 'fa-linkedin-sign', 'fa-pinterest', 'fa-pinterest-sign', 'fa-google-plus', 'fa-google-plus-sign', 'fa-sign-blank',
        ];
    }
}
if (!function_exists('getListDataType')) {
    function getListDataType()
    {
        return ["bigIncrements", "bigInteger", "binary", "boolean", "char", "date", "dateTime", "dateTimeTz", "decimal", "double", "enum", "float", "geometry", "geometryCollection", "increments", "integer", "ipAddress", "json", "jsonb", "lineString", "longText", "macAddress", "mediumIncrements", "mediumInteger", "mediumText", "morphs", "multiLineString", "multiPoint", "multiPolygon", "nullableMorphs", "nullableTimestamps", "point", "polygon", "rememberToken", "smallIncrements", "smallInteger", "softDeletes", "softDeletesTz", "string", "text", "time", "timeTz", "timestamp", "timestampTz", "timestamps", "timestampsTz", "tinyIncrements", "tinyInteger", "unsignedBigInteger", "unsignedDecimal", "unsignedInteger", "unsignedMediumInteger", "unsignedSmallInteger", "unsignedTinyInteger", "uuid", "year"];
    }
}

if (!function_exists('generateUuid')) {
    function generateUuid()
    {
        return (string) \Uuid::generate(4);
    }
}

if (!function_exists('saveImageFromBase64')) {
    function saveImageFromBase64($base64)
    {
        $imageData = explode(',', $base64)[1];
        $imageExtension = explode('/', explode(';', $base64)[0])[1];
        $imageName = generateUuid() . ".{$imageExtension}";
        $image = \Image::make(($imageData))->save(\Storage::disk('local')->path("public/{$imageName}"));
        return request()->getHttpHost() . \Storage::disk('local')->url("public/{$imageName}");
    }
}

if (!function_exists('deleteImageFromStorage')) {
    function deleteImageFromStorage($path)
    {
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
}
