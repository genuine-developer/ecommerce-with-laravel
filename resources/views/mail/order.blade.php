<table class="table table-bordered">
    <thead>
      <tr>
          <th style="border:1px solid green; width:10%;" scope="col">#SL</th>
          <th style="border:1px solid green; width:25%;" scope="col">Product Name</th>
          <th style="border:1px solid green; width:25%;" scope="col">Product Image</th>
          <th style="border:1px solid green; width:10%;" scope="col">Quantity</th>
          <th style="border:1px solid green; width:25%;" scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach ($data as $item)
            <tr style="border:1px solid green;">
                <th  style="border:1px solid green; width:33%;">{{ $loop->index+1 }}</th>
                <td style="border:1px solid green; width:33%;">{{ $item->product->title }}</td>
                <td style="border:1px solid green; width:33%;"><img src="{{ asset(''thumbnail/'. Carbon::now()->format('Y/m/').'/''$item->product->thumbnail)}}" alt="product image"></td>
                <td style="border:1px solid green; width:33%;">{{ $item->quantity }}</td>
                <td  style="border:1px solid green; width:33%;">{{ $item->product_unit_price }}</td>
                @php
                    $total = $item->quantity * $item->product_unit_price;
                @endphp
            </tr>
        @endforeach
        <span style="float: right;"> {{ $total }}</span>      
    </tbody>
  </table>