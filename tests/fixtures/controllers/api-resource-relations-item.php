<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ItemStoreRequest;
use App\Http\Requests\Api\ItemUpdateRequest;
use App\Http\Resources\Api\ItemCollection;
use App\Http\Resources\Api\ItemResource;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function index(Request $request, Order $order): ItemCollection
    {
        $items = $order->items()->get();

        return new ItemCollection($items);
    }

    public function store(ItemStoreRequest $request, Order $order): ItemResource
    {
        $item = $order->items()->create($request->validated());

        return new ItemResource($item);
    }

    public function show(Request $request, Order $order, Item $item): ItemResource
    {
        return new ItemResource($item);
    }

    public function update(ItemUpdateRequest $request, Order $order, Item $item): ItemResource
    {
        $item->update($request->validated());

        return new ItemResource($item);
    }

    public function destroy(Request $request, Order $order, Item $item): Response
    {
        $item->delete();

        return response()->noContent();
    }
}
