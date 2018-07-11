<?php

require __DIR__ . '/../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use OpenBanking\Config;
use OpenBanking\Api;

/**
 * @param string $apiId
 * @return array
 */
function batchApiCall($apiId)
{
    $config = new Config();
    $result = [];
    foreach ($config->bankIds() as $bankId) {
        $bankResult = [];
        try {
            $api  = new Api($bankId);
            $bankResult = $api->$apiId();//atms();
        } catch (\Exception $ex) {
            $bankResult['error'] = $ex->getMessage();
        }
        $result[$bankId] = $bankResult;
    }
    return $result;
}

try {

    error_log('API: ' . __FILE__);

    $app     = new \Slim\App;
    $appName = 'MyBanks OpenBanking API';

    // log middleware
    $app->add(function (Request $request, Response $response, callable $next) {
        error_log('API: ' . $request->getMethod() . ' ' . $request->getUri());

        return $next($request, $response);
    });

    $app->get('/', function (Request $request, Response $response, array $args) use ($appName) {
        return $response->withJson(['data' => $appName], 200);
    });

    $app->get('/api', function (Request $request, Response $response, array $args) use ($appName) {
        return $response->withJson(['data' => $appName], 200);
    });

    $app->get('/api/banks', function (Request $request, Response $response, array $args) {
        $config = new Config();
        $data   = $config->bankNames();
        return $response->withJson(['data' => $data], 200);
    });

    $app->get('/api/banks/{bankId}', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $config = new Config();
        $data   = $config->bank($bankId);
        return $response->withJson(['data' => $data], 200);
    });

    $app->get('/api/banks/{bankId}/atms', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->atms();
        return $response->withJson($data, 200);
    });

    $app->get('/api/banks/{bankId}/branches', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->branches();
        return $response->withJson($data, 200);
    });

    $app->get('/api/banks/{bankId}/business-current-accounts', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->business_current_accounts();
        return $response->withJson($data, 200);
    });

    $app->get('/api/banks/{bankId}/commercial-credit-cards', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->commercial_credit_cards();
        return $response->withJson($data, 200);
    });

    $app->get('/api/banks/{bankId}/personal-current-accounts', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->personal_current_accounts();
        return $response->withJson($data, 200);
    });

    $app->get('/api/banks/{bankId}/unsecured-sme-loans', function (Request $request, Response $response, array $args) {
        $bankId = $args['bankId'];
        $api    = new Api($bankId);
        $data   = $api->unsecured_sme_loans();
        return $response->withJson($data, 200);
    });

    $app->get('/api/batch/atms', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('atms');
        return $response->withJson(['data' => $result], 200);
    });

    $app->get('/api/batch/branches', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('branches');
        return $response->withJson(['data' => $result], 200);
    });

    $app->get('/api/batch/business-current-accounts', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('business_current_accounts');
        return $response->withJson(['data' => $result], 200);
    });

    $app->get('/api/batch/commercial-credit-cards', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('commercial_credit_cards');
        return $response->withJson(['data' => $result], 200);
    });

    $app->get('/api/batch/personal-current-accounts', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('business_current_accounts');
        return $response->withJson(['data' => $result], 200);
    });

    $app->get('/api/batch/unsecured-sme-loans', function (Request $request, Response $response, array $args) {
        $result = batchApiCall('unsecured_sme_loans');
        return $response->withJson(['data' => $result], 200);
    });

    $app->run();

} catch (Exception $ex) {
    echo json_encode([ 'error' => $ex->getMessage() ]);
}
