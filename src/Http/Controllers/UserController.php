<?php
namespace Valiria\Http\Controllers;

use Illuminate\Http\Request;
use Valiria\Http\Resources\UserCollection;
use Valiria\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $limit = request()->has('limit') ? request()->get('limit') : null;
        return new UserCollection(User::paginate($limit));
    }

    public function store(Request $request)
    {
        return new UserResource(User::create($request->all()));
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
