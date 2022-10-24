<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="selectbarang">Barang</label>
  <div class="col-sm-10">
    <select class="form-control" id="selectbarang" name="id_barang[]" required>
      <option ></option>
      @foreach ($databarang as $barang)
          <option value="{{$barang['id']}}">{{$barang['nama']}}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="jumlah[]">Jumlah Barang</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="jumlah[]" name="jumlah[]" min="0" required/>
  </div>
</div>
