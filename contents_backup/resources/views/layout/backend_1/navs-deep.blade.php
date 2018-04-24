                    <li><a><i class="fa fa-edit"></i>Attribute Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><?php echo HTML::link('/test','Demo');?></li>
                            <li><?php echo HTML::link(route('attributes.index'),'Attribute List');?></li>
                            <li><?php echo HTML::link(route('attributesassoc.index'),'Attribute Association');?></li>
                            <li><?php echo HTML::link(route('attributestype.index'),'Attribute Data Type');?></li>
                            <li><?php echo HTML::link(route('dropdownoptions.index'),'Dropdown Option List');?></li>
                        </ul>
                    </li>                    
                    
                    <li><a><i class="fa fa-edit"></i>Category Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><?php echo HTML::link(route('categories.index'),'Categories');?></li>
                            <li><a href="{!! route('dashboard-category-upload-create')!!}">Categories Import</a></li>
                        </ul>
                    </li> 
                    
                    <li><a><i class="fa fa-edit"></i>Product Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><?php echo HTML::link(route('products/list'),'View Products');?></li>
                        </ul>
                    </li>                     
                    <li><a><i class="fa fa-edit"></i>Store<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><?php echo HTML::link(route('store/list'),'View Store');?></li>
                        </ul>
                    </li>   