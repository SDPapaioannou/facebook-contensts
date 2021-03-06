<?php
class SDP_FB {

    static function pluralize($word, $length) {
        return $length > 1 || $length === 0
            ? "{$word}s"
            : $word;
    }

    static function get_open_graph_uri() {
        return 'https://graph.facebook.com';
    }

    static function get_access_token() {
        $app_id = 615347261977517;
        $app_secret = '533b1b36d117d2ace91552533f34e68e';

        return "$app_id|$app_secret";
    }

    static function get_og_object($url) {
        $base_url = self::get_open_graph_uri();
        $uri = "$base_url?ids=$url";

        return SDP_API::GET($uri);
    }

    static function get_og_object_id($og_data) {
        $og_data = reset($og_data);
        return (
            isset($og_data['og_object'])
                ? $og_data['og_object']['id']
                : null
        );
    }

    static function has_likes($obj_id) {
        return $obj_id !== null;
    }

    static function get_object_likes_count_($url) {
        return sizeof(self::get_object_likes($url));
    }

    public static function get_object_likes($url) {
        $likes = [];
        $og_data = self::get_og_object($url);
        $obj_id = self::get_og_object_id($og_data);

        if (self::has_likes($obj_id)) {
            $access_token = self::get_access_token();
            $base_url = self::get_open_graph_uri();
            $uri = "$base_url/$obj_id/likes?access_token=$access_token";
            $likes = SDP_API::GET($uri)['data'];
        }

        return $likes;
    }

    public static function the_object_likes_count($url) {
        echo self::get_object_likes($url)->count;
    }

    public static function get_object_likes_count_with_description($url) {
        $likes = self::get_object_likes($url);
        $likes_count = empty($likes) ? 0 : sizeof($likes);
        $likes_desc = self::pluralize('like', $likes_count);

        echo "$likes_count $likes_desc";
    }

    public static function get_user_data($user_id) {
        $base_url = self::get_open_graph_uri();
        $access_token = self::get_access_token();
        $fields = 'fields=name,email';
        $uri = "$base_url/$user_id?$fields&access_token=$access_token";

        return SDP_API::GET($uri);
    }
}
?>
