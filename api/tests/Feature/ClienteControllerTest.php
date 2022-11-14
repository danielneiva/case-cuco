<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEmpty;

class ClienteControllerTest extends TestCase
{
    //use RefreshDatabase;


    /**
     * Testa se o endpoint de index consegue retornar todos os clientes
     *
     * @return void
     */
    public function test_clientes_sao_retornados_no_metodo_index()
    {
        //Checa se clientes não existem
        $clientesExistem = Cliente::all();
        assertEmpty($clientesExistem);

        //Cria clientes fake no banco
        $clientes = Cliente::factory()->count(10)->create();

        //Envia request de cadastro
        $response = $this->get('/api/v1/clientes');

        //Checa se o código de resposta é 200 e se a lista de clientes é retornada
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($clientes->toArray());
    }

    /**
     * Testa se o endpoint de store consegue criar um cliente
     *
     * @return void
     */
    public function test_cliente_e_criado_no_metodo_store()
    {
        //Checa se cliente não existe
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertEmpty($clienteExiste);

        //Envia request de cadastro
        $cliente = [
            'nome' => 'João da Silva',
            'cpf' => '000.000.000-00',
            'nascimento' => '1999-01-01',
            'telefone' => '31999999999',
        ];
        $response = $this->post('/api/v1/clientes', $cliente);

        //Checa se o código de resposta é 201 e se o resource foi recebido
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($cliente);


        //Checa se o cliente realmente foi criado
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertNotEmpty($clienteExiste);
    }


    /**
     * Testa se o endpoint de show retorna um cliente específico
     *
     * @return void
     */
    public function test_cliente_especifico_e_retornado_no_metodo_show()
    {
        //Checa se cliente não existe
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertEmpty($clienteExiste);

        //Cria um cliente
        $cliente = Cliente::create([
            'nome' => 'João da Silva',
            'cpf' => '000.000.000-00',
            'nascimento' => '1999-01-01',
            'telefone' => '31999999999',
        ]);

        //Envia request de busca
        $response = $this->get('/api/v1/clientes/' . $cliente->id);

        //Checa se o código de resposta é 201 e se o resource correto foi recebido
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($cliente->toArray());
    }

    /**
     * Testa se o endpoint de update atualiza um cliente
     *
     * @return void
     */
    public function test_cliente_especifico_e_atualizado()
    {
        //Checa se cliente não existe
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertEmpty($clienteExiste);

        //Cria um cliente
        $cliente = Cliente::create([
            'nome' => 'João da Silva',
            'cpf' => '000.000.000-00',
            'nascimento' => '1999-01-01',
            'telefone' => '31999999999',
        ]);

        //Dados que serão atualizados no cliente
        $dadosAtualizados = [
            'nome' => 'Maria da Silva',
            'cpf' => '111.111.111-11',
            'nascimento' => '1980-12-12',
            'telefone' => '31988888888',
        ];

        //Envia request de atualização
        $response = $this->put('/api/v1/clientes/' . $cliente->id, $dadosAtualizados);

        //Checa se o código de resposta é 201 e se o resource correto foi recebido
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($dadosAtualizados);

        //Checa se o cliente foi atualizado no banco
        $clienteNovo = Cliente::select('nome', 'cpf', 'nascimento', 'telefone')->where('id', $cliente->id)->first();
        assertEquals($clienteNovo->toArray(), $dadosAtualizados, 'não atualizou direito');
    }



    /**
     * Testa se o endpoint de delete apaga um cliente
     *
     * @return void
     */
    public function test_cliente_especifico_e_deletado()
    {
        //Checa se cliente não existe
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertEmpty($clienteExiste);
        
        //Cria um cliente
        $cliente = Cliente::create([
            'nome' => 'João da Silva',
            'cpf' => '000.000.000-00',
            'nascimento' => '1999-01-01',
            'telefone' => '31999999999',
        ]);

        //Checa se cliente existe
        $clienteExiste = Cliente::where('cpf', '000.000.000-00')->get();
        assertNotEmpty($clienteExiste);


        //Envia request de deleção
        $response = $this->delete('/api/v1/clientes/' . $cliente->id);

        //Checa se o código de resposta é 200
        $response
            ->assertStatus(Response::HTTP_OK);

        //Checa se o cliente foi deletado
        $cliente = Cliente::where('cpf', '000.000.000-00')->first();
        assertEmpty($cliente);
        
    }
}
