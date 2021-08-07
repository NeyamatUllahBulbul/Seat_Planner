<div class="row" >
    @php
    $i=0;
    @endphp
    @foreach($stocks as $stock)
    @php
    $getShopData = _getRelContent($stock->relShopContent);
    $getGoodsData = _getRelContent($stock->relGoodContent);
    @endphp
    <div class="tag-col ml-4 mt-5" >
        <div class="pull-left text-center mb-4" style="width: 54mm">
            <p><b>{{ $getShopData['heading'] }}</b></p>
            @foreach($stock->stockMetal as $metal)
            @php
            $getMetalData = _getRelContent($metal->relContent)
            @endphp
            <p class="mb-0">
                {{ $getMetalData['heading'] }} #
                @if($metal->relMetal->unit == \App\Enum\Units::GM)
                {{ getMinifiedTraditionalUnit($metal->quantity) }} ({{ $metal->relCarat->carat }})
                @else
                {{ $metal->quantity }} {{ trans('admin/metal/form.' . $metal->relMetal->unit) }}
                @endif
            </p>
            @endforeach
        </div><br>
        <div class=" text-center" style="width: 54mm;">
            <div style="width: fit-content; margin: auto">
                <?php
                echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($stock->uid, "C128A", 1, 18) . '" alt="barcode" style="height : 40px; width : 164px;"  />';
                ?>
            </div>
            <p style="display: inline-block">{{ $getGoodsData['heading'] }} # {{ transNumbers($stock->uid) }}</p>
        </div>
    </div>
    @php
    $i++;
    @endphp
    @if($i==3)
    @php
    $i=0;
    @endphp
</div>
<div class="row" >
    @endif
    @endforeach
</div>
