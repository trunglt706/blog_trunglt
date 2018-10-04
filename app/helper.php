<?php
/**
 * @function active menu haven't sup item
 * @param Route $route
 * @param string $output
 * @return string
 */
function isActiveRoute($route, $output = "active") {
    if (Route::currentRouteName() == $route) {
        return $output;
    }
}

/**
 * @function active menu have sup item
 * @param array $routes
 * @param string $output
 * @return string
 */
function areActiveRoutes(Array $routes, $output = "active") {
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

/**
 * @function get info from username
 * @param $username
 * @return null
 */
function getUser($username) {
    $rs = null;
    $admin = \App\admins::where('username', $username)->first();
    if(!is_null($admin)) {
        $rs = $admin;
    }
    $user = \App\users::where('username', $username)->where('status', 1)->first();
    if(!is_null($user)) {
        $rs = $user;
    }
    return $rs;
}