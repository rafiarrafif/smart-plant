<?php

namespace App\Http\Middleware;

use App\Models\VisitorCount as ModelsVisitorCount;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as IPRequest;
use Symfony\Component\HttpFoundation\Response;
use WhichBrowser\Parser;

class VisitorCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $visitorIPCheck = ModelsVisitorCount::where('ip_address', IPRequest::ip())->first();
        if(!$visitorIPCheck) {
            $parser = new Parser($_SERVER['HTTP_USER_AGENT']);
            $data = [
                'ip_address' => IPRequest::ip(),
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'device_model' => $parser->isType('desktop') ? 'Desktop' : 'Mobile',
                'device_platform' => $parser->os->toString(),
                'browser_version' => $parser->browser->toString(),
                'last_visit' => now()
            ];
            ModelsVisitorCount::create($data);
        } else {
            $visitorIPCheck->last_visit = now();
            $visitorIPCheck->save();
        }
        
        return $next($request);
    }
}