site da aplicação <br>

@auth
    <h1>Usuário autenticado</h1>
    {{ Auth::user()->id }} <br>
    {{ Auth::user()->name }} <br>
    {{ Auth::user()->email }}
    @if(Auth::user()->id == 2)
        <p>Parabens você pode ver a mensagem</p>
    @endif
@endauth

@guest
<p> Olá visitante </p>
@endguest