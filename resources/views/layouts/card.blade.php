<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{Storage::url($product->image)}}" style="width: 250px;height: 300px;" alt="">
        <div class="caption">
            <h3>{{$product->name}}</h3>
            <p><b>$ </b>{{$product->price}}</p>
            <h4>{{$product->category->name}}</h4>
            <p>
                <a href="{{route('product',[$product->category->code,$product->code])}}"
                   class="btn btn-default"
                   role="button">More</a>
            <form action="{{route('basket-add',$product)}}" method="post">
                @csrf
                <button type="submit"
                        class="btn btn-primary"
                        role="button">Add to basket
                </button>
            </form>
            </p>
        </div>
    </div>
</div>
