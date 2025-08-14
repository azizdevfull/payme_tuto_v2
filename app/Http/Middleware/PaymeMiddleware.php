<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');
        // \Log::info('authorization: ' . $authorization);
        if (!$authorization || !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $authorization, $matches)) {
            return response()->json([
                'jsonrpc' => '2.0',
                'error' => [
                    'code' => -32504,
                    'message' => [
                        "uz" => "Avtorizatsiyadan otishda xatolik",
                        "ru" => "Ошибка аутентификации",
                        "en" => "Auth error"
                    ]
                ]
            ]);
        }
        // \Log::info("Matches:" . $matches[1]);
        $decodedCredentials = base64_decode($matches[1]);
        // \Log::info("Decoded credentials:" . $decodedCredentials);
        list($username, $password) = explode(':', $decodedCredentials);
        // \Log::info('Username and Password: ' . $username . ':' . $password);
        $expectedUsername = "Paycom"; // username
        $expectedPassword = "Y6f0Ii4NvFPbAQc4Nzvc75edBVCZ4nCd689dae9a5a358"; // parol

        if ($username !== $expectedUsername || $password !== $expectedPassword) {
            return response()->json([
                'jsonrpc' => '2.0',
                'error' => [
                    'code' => -32504,
                    'message' => [
                        "uz" => "Avtorizatsiyadan otishda xatolik",
                        "ru" => "Ошибка аутентификации",
                        "en" => "Auth error"
                    ]
                ]
            ]);
        }

        return $next($request);
    }
}