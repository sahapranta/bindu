<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeploymentController extends Controller
{
    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $msg = $request->get('head_commit.message');
        $localToken = env('APP_DEPLOY_SECRET');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {
            $pull = NULL;
            $commit = NULL;
            Artisan::call('down');
            exec('git fetch');
            exec('git pull', $pull);
            exec("git commit -m $msg", $commit);
            Artisan::call('up');
            return response()->json(['pull' => $pull, 'commit' => $commit], 200);
        }
        return response()->json(['status' => 'Secret not matched'], 404);
    }
}
