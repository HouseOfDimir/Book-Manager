<div class="container mt-3 forAlert">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block row"> 
            <div class="col-md-8">
                <strong>{{ $message }}</strong>
            </div>  
            <div class="d-flex flex-row-reverse col-md-4">
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times text-right"></i></button> 
            </div>
        </div>
    @endif
    
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block row">   
            <div class="col-md-8">
                <strong>{{ $message }}</strong>
            </div>  
            <div class="d-flex flex-row-reverse col-md-4">
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times text-right"></i></button> 
            </div>
        </div>
    @endif
    
    @if ($message = Session::get('warning'))
        <div class="col-md-8">
            <strong>{{ $message }}</strong>
        </div>  
        <div class="d-flex flex-row-reverse col-md-4">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times text-right"></i></button> 
        </div>
    @endif
    
    @if ($message = Session::get('info'))
        <div class="col-md-8">
            <strong>{{ $message }}</strong>
        </div>  
        <div class="d-flex flex-row-reverse col-md-4">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times text-right"></i></button> 
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger row">
            <div class="col-md-8">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
            
            <div class="d-flex flex-row-reverse col-md-4">
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times text-right"></i></button> 
            </div>   
        </div>
    @endif
</div>