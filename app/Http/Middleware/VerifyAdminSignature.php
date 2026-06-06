<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminSignature
{
    public function handle(Request $request, Closure $next): Response
    {
        $signature = $request->query('signature');
        $expires = $request->query('expires');

        // Both must be present
        if (!$signature || !$expires) {
            abort(403, 'Invalid report link. Missing signature.');
        }

        // Check if the URL has expired
        if (time() > (int) $expires) {
            abort(403, 'This report link has expired. Please generate a new one from the admin panel.');
        }

        // Reconstruct the expected signature
        $secret = config('services.admin_report.secret');
        if (!$secret) {
            abort(500, 'Admin report secret is not configured.');
        }

        $path = $request->path(); // e.g. "admin-report/5/12"
        $expectedSignature = hash_hmac('sha256', "{$path}|{$expires}", $secret);

        // Timing-safe comparison
        if (!hash_equals($expectedSignature, $signature)) {
            abort(403, 'Invalid report link. Signature verification failed.');
        }

        return $next($request);
    }
}
