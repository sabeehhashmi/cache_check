
<?php
namespace userFilters;

use IlluminateRoutingRoute;
use IlluminateHttpRequest;
use IlluminateHttpResponse;

use Str;
use Cache;

class CacheFilter {

    public function grab( Route $route, Request $request )
    {
        $key = $this->keygen($request->url());

        if( Cache::has( $key ) ) return Cache::get( $key );
    }

    public function set( Route $route, Request $request, Response $response )
    {
        $key = $this->keygen($request->url());

        if( ! Cache::has( $key ) ) Cache::put( $key, $response->getContent(), 60 );
    }

    protected function keygen( $url )
    {
        return 'route_' . Str::slug( $url );
    }
    public function forgot(Route $route, Request $request){
        $key = $this->keygen($request->url());
        Cache::forget( $key );
    }

}
