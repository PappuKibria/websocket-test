<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Http\Request;
use Pusher\Pusher;

class SendMessage implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;
    public $data = ['asas'];
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user-channel');
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public static function broadcastWith(Request $request)
    {
        $options = array(
            'cluster' => 'mt1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '84213bf659057d4f6a6b',
            '80bbbe4532337c0b28de',
            '1570025',
            $options
        );

        $data['message'] = $request->message;
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
