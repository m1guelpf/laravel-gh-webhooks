<?php

namespace M1guelpf\GHWebhooks;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GHWebhooks
{
    /**
     * Handle a webhook coming from GitHub.
     *
     * @return Response
     */
    public function handle()
    {
        if (config('ghwebhooks.secret')) {
            throw_unless($this->githubSignatureIsValid(), new BadRequestHttpException(config('ghwebhooks.secreterror', "This action didn't come from GitHub or webhooks aren't properly configured.")));
        }

        $class = sprintf(config('ghwebhooks.eventclass'), ucfirst(camel_case(request()->header('X-GitHub-Event'))));

        throw_unless(class_exists($class), new BadRequestHttpException(config('ghwebhooks.eventerror', 'Event not supported.')));

        $data = request()->input();

        if (class_exists(config('ghwebhooks.model'))) {
            $model = config('ghwebhooks.model')::where(config('ghwebhooks.model_key', 'id'), array_get($data, config('ghwebhooks.payload_key', 'repository.id'), 'repository.id'))->first();

            throw_unless(!is_null($model) && $model->exists, new BadRequestHttpException(config('ghwebhooks.modelerror', "This repository doesn't exist in this application.")));
            event(new $class($data, $model));

            return response()->json(config('ghwebhooks.response', ['message' => 'Event successfully received.']));
        }

        event(new $class($data));

        return response()->json(config('ghwebhooks.response', ['message' => 'Event successfully received.']));
    }

    /**
     * Check if a webhook request came from GitHub.
     *
     * @return bool
     */
    protected function githubSignatureIsValid() : bool
    {
        $gitHubSignature = request()->header('X-Hub-Signature', 'PlaceHolderHash');
        list($usedAlgorithm, $gitHubHash) = explode('=', $gitHubSignature, 2);
        $payload = file_get_contents('php://input');
        $calculatedHash = hash_hmac($usedAlgorithm, $payload, config('ghwebhook.secret'));

        return $calculatedHash === $gitHubHash;
    }
}
