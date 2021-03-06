<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItem;
use App\Models\Review;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;

    public function mount($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'comment' => 'required',
            'rating' => 'required',
        ]);
    }

    public function addReview()
    {
        $this->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);
        $review = new Review();
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->order_item_id;
        $review->save();

        $orderItem = OrderItem::find($this->order_item_id);
        $orderItem->rstatus = true;
        $orderItem->save();
        session()->flash('success', 'Review added successfully');
    }
    public function render()
    {
        $orderItem = OrderItem::find($this->order_item_id);
        return view('livewire.user.user-review-component', ['orderItem' => $orderItem])->layout('layouts.base');
    }
}
