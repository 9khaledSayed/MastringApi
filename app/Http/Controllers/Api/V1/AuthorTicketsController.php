<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorTicketsController extends ApiController
{
    public function index($authorId, TicketFilter $filters)
    {
        return TicketResource::collection(Ticket::whereUserId($authorId)->filter($filters)->paginate());
    }

    public function store(User $author, StoreTicketRequest $request)
    {

        $data = [
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'status' => $request->input('data.attributes.status'),
            'user_id' => $author->id
        ];

        return new TicketResource(Ticket::create($data));
    }

    public function destroy($authorId, $ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            if ($ticket->user_id == $authorId) {
                $ticket->delete();
                return $this->ok('Ticket deleted successfully');
            }

            return $this->error('Ticket not found.', 404);

        } catch (ModelNotFoundException $e) {
            return $this->error('Ticket not found.', 404);
        }
    }
}
