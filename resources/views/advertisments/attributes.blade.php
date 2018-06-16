@if(count($Attributes) > 0)
    @foreach($Attributes as $attribute)
        <div class="form-group">
            @php
                $Attribute = $Category->AttributeByID($attribute->attribute_id);
            @endphp
            <label>{{ $Attribute->attribute_name }}</label>

            @if($Attribute->attribute_type == 1)
                <input type="text"  class="form-control"  value="" name="advertisment_attribute[{{$Attribute->id}}]"/>
            @endif

            @if($Attribute->attribute_type == 2)
                <textarea name="{{$Attribute->id}}" class="form-control"></textarea>
            @endif

            @if($Attribute->attribute_type == 3)
                @php $Values = explode('|', $Attribute->attribute_values) @endphp

                @if(count($Values) > 0)
                    <select class="form-control" name="advertisment_attribute[{{$Attribute->id}}]">
                        <option>Select {{$Attribute->attribute_name}}</option>
                    @foreach($Values as $Value)
                        <option value="{{trim($Value)}}">{{ trim($Value)}}</option>
                    @endforeach
                    </select>
                @endif
            @endif

            @if($Attribute->attribute_type == 4)
                @php $Values = explode('|', $Attribute->attribute_values) @endphp

                @if(count($Values) > 0)
                    @foreach($Values as $Value)
                        <div class="form-group">
                            <label>
                                <input type="radio" class="minimal" name="advertisment_attribute[{{$Attribute->id}}]" value="{{trim($Value)}}">
                                {{trim($Value)}}
                            </label>
                        </div>
                    @endforeach
                @endif
            @endif

            @if($Attribute->attribute_type == 5)
                @php $Values = explode('|', $Attribute->attribute_values) @endphp

                @if(count($Values) > 0)
                    @foreach($Values as $Value)
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="minimal" name="advertisment_attribute[{{$Attribute->id}}][]" value="{{trim($Value)}}">
                                {{trim($Value)}}
                            </label>
                        </div>
                    @endforeach
                @endif
            @endif

        </div>
    @endforeach
@endif