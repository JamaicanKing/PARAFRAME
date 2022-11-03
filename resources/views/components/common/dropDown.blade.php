

<label style="color:black">{{ __($fieldLabel) }}</label>
 

  
    <div class="form-group col-md-6"><select class="form-control" type="text" style="text=align:center" id="{{ $fieldName }}"  name="{{ $fieldName }}" onchange="{{ (isset($Onchange)) }}" >
            <option id='defaultOption' value="">{{ __($defaultDropDownOption) }}</option>
            @if(isset($options))
                @foreach ( $options as $option )
                    <option 
                        {{ (isset($selectedId) && $selectedId == $option->name ) ? 'selected' : '' }}  
                        value="{{ $option->id ?? '' }}" >{{ __($option->name ?? '' ) }}
                    </option>  
                @endforeach
            @endif
            
    
        </select>
        @error($fieldName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>