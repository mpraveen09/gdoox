        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>{!! $field['product_name']->label!!}</th>
                    <th>Site Name</th>
                    <th>{!! $field['post_date']->label!!}</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>  
            @foeach($ecomsites as $site)
            <tr>
              <td>{!!$site->ecom_company_name!!}</td>
              <td>{!!$site->slug!!}</td>
            </tr>
            @endforeach
            @foreach( $MultiItemProducts as $product )
                <tr>
                    <td>{!! $product->desc!!}</td>
                    <td>{!! $product->shopid!!}</td>
                    <td>{!! $product->postdate!!}</td>
                    <td>
<!--                      <a href="{!!route($product_type["type"].'.add_multi_item_details', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Add Muli Item Details" ><i class='zmdi zmdi-eye zmdi-hc-fw'></i>Add Details</a>-->
                      <a href="{!!route($product_type["type"].'.add_product', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Add/Remove Products" >Add/Remove Products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{!!route($product_type["type"].'.edit', $product->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i>Edit Details</a>
                    </td>
                    <td>
                      @if($product->status === "disabled")
                      <a href="{!!route($product_type["type"].'.toggle', [$product->id, 'status'=>'enabled'])!!}"data-toggle="tooltip" data-placement="bottom" title="Enable" >Enable On Site</a>
                      @else
                      <a href="{!!route($product_type["type"].'.toggle', [$product->id, 'status'=>'disabled'])!!}" data-toggle="tooltip" data-placement="bottom" title="Disable" >Disable From Site</a>
                      @endif
                    </td>
                </tr>  
            @endforeach
            </tbody>
        </table>

