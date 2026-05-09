<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\json;

class Chat extends Component
{
    public $messages = [];
    public $userMessage = "";
    public $loading = false;
    public $aiRolePrompt = "";

    public function mount()
    {
        $userId = Auth::id();
        $transactionData = Transaksi::where('user_id', $userId)
            ->orderBy('tanggal_transaksi', 'desc')
            ->take(5)
            ->get();
        $this->aiRolePrompt = "Kamu adalah asisten virtual yang membantu pemilik UMKM dengan pertanyaan terkait data transaksi mereka.";
        $this->aiRolePrompt .= "\nBerikut adalah data transaksi terbaru:\n";
        $this->aiRolePrompt .= json_encode($transactionData);
        $this->aiRolePrompt .= "\nJawablah beberapa pertanyaan yang akan ditanyakan nanti.";
    }

    public function setMessage($text, $send = false)
    {
        $this->userMessage = $text;
        if ($send) {
            $this->sendMessage(app(GeminiService::class));
        }
    }

    public function sendMessage(GeminiService $gemini)
    {
        $this->validate(['userMessage' => 'required|string|min:2']);

        $this->messages[] = [
            "role" => "user",
            "content" => $this->userMessage
        ];


        $allMessages = array_merge([
            ["role" => "user", "content" => $this->aiRolePrompt]
        ], $this->messages);

        $reply = $gemini->chat($allMessages);

        $this->messages[] = [
            "role" => "model",
            "content" => $reply
        ];

        $this->userMessage = "";
        $this->loading = true;
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
