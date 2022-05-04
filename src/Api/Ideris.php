<?php

namespace Ideris\Api;

use Ideris\Client\ApiClient;
use Ideris\Client\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Ideris\Endpoints\Auth as AuthEndpoint;
use Ideris\Endpoints\Atualizacao as UpdateEndpoint;
use Ideris\Endpoints\Status as StatusEndpoint;
use Ideris\Endpoints\Marketplace as MarketplaceEndpoint;
use Ideris\Endpoints\Protocolo as ProtocolEndpoint;
use Ideris\Endpoints\Conta as AccountEndpoint;
use Ideris\Endpoints\Produto\Ncm as NcmEndpoint;
use Ideris\Endpoints\Produto\Marca as MarcaEndpoint;
use Ideris\Endpoints\Produto\Departamento as DepartamentoEndpoint;
use Ideris\Endpoints\Produto\Origem as OrigemEndpoint;
use Ideris\Endpoints\Produto\Categoria as CategoriaEndpoint;
use Ideris\Endpoints\Produto\SubCategoria as SubCategoriaEndpoint;
use Ideris\Endpoints\Produto\Produto as ProdutoEndpoint;
use Ideris\Helper\JWT;
use Ideris\Helper\StateService;
use Psr\Http\Message\ResponseInterface;

class Ideris
{
    /**
     * Login token
     * @var string
     */
    protected $login_token = '';

    /**
     * JWT Token
     * @var string
     */
    protected $jwt_token = '';

    /**
     * Api uri
     * @var string
     */
    protected $uri_base = 'http://api.ideris.com.br';

    /**
     * @var ApiClient
     */
    protected $apiClient;

    public function __construct(string $login_token)
    {
        $this->login_token = $login_token;
        self::checkAuth();
    }

    protected function makeStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
            return new Response(
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getBody(),
                $response->getProtocolVersion(),
                $response->getReasonPhrase());
        }));

        return $stack;
    }

    public function getApiClient(): ApiClient
    {
        if ($this->jwt_token)
            $headers['Authorization'] = $this->jwt_token;
        else
            $headers['json'] = ['login_token' => $this->login_token];

        $this->apiClient = new ApiClient([
            'base_uri' => $this->uri_base,
            'handler'  => self::makeStack(),
            'headers'  => $headers
        ]);

        return $this->apiClient;
    }

    protected function checkAuth()
    {
        $stateService = new StateService();

        $stateKey = AuthEndpoint::PREFIX_KEY_STATE . md5($this->login_token);

        $this->jwt_token = $stateService->getState($stateKey);

        if (!$this->jwt_token || JWT::verifyExpired($this->jwt_token)) {
            $authPoint = new AuthEndpoint($this->getApiClient());
            $authModel = $authPoint->authentication($this->login_token);
            $this->jwt_token = $authModel->getJwtToken();
            $stateService->saveState($stateKey, $this->jwt_token);
        }
    }

    /**
     * @return AuthEndpoint
     */
    public function auth(): AuthEndpoint
    {
        return new AuthEndpoint($this->getApiClient());
    }

    /**
     * @return UpdateEndpoint
     */
    public function update(): UpdateEndpoint
    {
        return new UpdateEndpoint($this->getApiClient());
    }

    /**
     * @return StatusEndpoint
     */
    public function status(): StatusEndpoint
    {
        return new StatusEndpoint($this->getApiClient());
    }

    /**
     * @return MarketplaceEndpoint
     */
    public function marketplace(): MarketplaceEndpoint
    {
        return new MarketplaceEndpoint($this->getApiClient());
    }

    /**
     * @return ProtocolEndpoint
     */
    public function protocol(): ProtocolEndpoint
    {
        return new ProtocolEndpoint($this->getApiClient());
    }

    /**
     * @return AccountEndpoint
     */
    public function account(): AccountEndpoint
    {
        return new AccountEndpoint($this->getApiClient());
    }

    /**
     * @return NcmEndpoint
     */
    public function ncm(): NcmEndpoint
    {
        return new NcmEndpoint($this->getApiClient());
    }

    /**
     * @return MarcaEndpoint
     */
    public function marca(): MarcaEndpoint
    {
        return new MarcaEndpoint($this->getApiClient());
    }

    /**
     * @return DepartamentoEndpoint
     */
    public function departamento(): DepartamentoEndpoint
    {
        return new DepartamentoEndpoint($this->getApiClient());
    }

    /**
     * @return OrigemEndpoint
     */
    public function origem(): OrigemEndpoint
    {
        return new OrigemEndpoint($this->getApiClient());
    }

    /**
     * @return CategoriaEndpoint
     */
    public function categoria(): CategoriaEndpoint
    {
        return new CategoriaEndpoint($this->getApiClient());
    }

    /**
     * @return SubCategoriaEndpoint
     */
    public function subCategoria(): SubCategoriaEndpoint
    {
        return new SubCategoriaEndpoint($this->getApiClient());
    }

    /**
     * @return ProdutoEndpoint
     */
    public function produto(): ProdutoEndpoint
    {
        return new ProdutoEndpoint($this->getApiClient());
    }
}