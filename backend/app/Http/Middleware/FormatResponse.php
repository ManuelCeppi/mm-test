<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class FormatResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->acceptsJson()) {
            // Content is already JSON because of response() method
            $content = json_decode($response->getContent(), true);

            // Wrap response if not an error
            if (!isset($content['error'])) {
                $jsonResponse = [
                    'error' => null,
                    'errorEx' => null,
                    'result' => $content
                ];
                $content = $jsonResponse;
            }

            // Unset the exception if production env
            if (App::environment(['production'])) {
                unset($content['errorEx']);
            }

            $response->setContent(json_encode($content));
        }

        return $response;
    }
}