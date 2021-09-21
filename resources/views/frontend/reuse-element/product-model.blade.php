 {{-- Modal For Deals product --}}
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="..." width="200px" height="200px" id="pthumbnail">
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                            <li class="list-group-item">Product Price: <strong id="pprice"></strong></li>
                          <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                          <li class="list-group-item">Stock: <strong id="pstock"></strong></li>
                        </ul>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><strong  id="attr_name"></strong></label>
                        <div class="c-inputs-stacked">
                            <input name="attr_name" type="checkbox" id="radio_123" value="1">
                            <label for="radio_123" class="mr-30">Credit Card</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Quantity:</label>
                        <input type="number" class="form-control" value="1" min="1">
                    </div>

                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </div>

        </div>
        {{-- End Model Body --}}
      </div>
    </div>
</div>
