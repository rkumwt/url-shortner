use Illuminate\Auth\AuthenticationException;

protected function unauthenticated($request, AuthenticationException $exception)
{
return response()->json([
'status' => false,
'message' => 'Unauthenticated',
'data' => null
], 401);
}