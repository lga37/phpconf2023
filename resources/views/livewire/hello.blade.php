<div>

    <h1>Ola Mundo</h1>

    <p>nome:<input type="text" wire:model.live.debounce.100ms="nome"></p>
    <p>nome:{{ $nome }}</p>

    <p>contador: {{ $count }}</p>

    <p>
        <a href="#" wire:mouseenter="incr()">incr</a> -
        <a href="#" wire:click="decr()">decr</a> -
    </p>

    <p wire:click='javascr'>acionar um js</p>

    <p>timestamp</p>

    Timestamp:{{ time() }}

    <button wire:click="$refresh">F5</button>
</div>

