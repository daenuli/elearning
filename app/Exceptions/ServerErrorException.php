<?php
 
namespace App\Exceptions;
 
use Exception;
use Inertia\Inertia;
 
class InvalidOrderException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $response = parent::render($request, $e);

        if (!app()->environment(['local', 'testing']) && in_array($response->status(), [500, 503, 404, 403])) {
            return Inertia::render('Error', ['status' => $response->status()])
                ->toResponse($request)
                ->setStatusCode($response->status());
        } else if ($response->status() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        return $response;
    }
}