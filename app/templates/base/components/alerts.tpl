<div class="messages-container">
    @forelse($messages as $message)
    <div class="alert @{$message['type']}">
        <div class="message">
            @{$message['text']}
        </div>
        <div class="close"><i class="material-icons">close</i></div>
    </div>
    @empty
    @endforelse
</div>