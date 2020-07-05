<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center pb-2">
            <div class="mr-auto">
                <span class="badge-spill">S</span>
            </div>
            <button class="btn btn-delete float-right">Удалить</button>
        </div>
        <div class="form-row">
            <div class="form-group col-md-9">
                <label>Имя</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Статус</label>
                <select class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Событие в амгазине</label>
            <select class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
            <small class="form-text text-muted">
                Событие в магазине которое отслеживать
            </small>
        </div>
    </div>
</div>

<div class="delimiter">
    |
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center pb-2">
            <span class="badge-spill">S</span>
        </div>
        <div class="form-group">
            <label>Действие</label>
            <select class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="form-group">
            <label>Книга</label>
            <select class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
            <small class="form-text text-muted">
                Книга в которую будут экспортироваться данные
            </small>
        </div>
        <div class="form-group">
            <label>POST URL</label>
            <input type="text" class="form-control">
            <small class="form-text text-muted">
                POST URL события в A360 SendPulse
            </small>
        </div>
    </div>
</div>

<div class="delimiter">
    |
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <span class="badge-spill">S</span>
        </div>
        <br>
        <div class="col-12">
            <div class="form-row p-0 pt-1">
                <div class="form-group col-7">
                    <input type="text" required="required" placeholder="localization.user_var" class="form-control">
                </div>
                <div class="form-group col-4">
                    <select class="form-control">
                        <option selected>Choossses..ффs.</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-1">
                    <button class="btn btn-delete-var">s</button>
                </div>
            </div>
            {{--            сруктура--}}
            <div class="form-row p-0 pt-1">
                <div class="form-group col-7">
                    <input type="text" required="required" placeholder="localization.user_var" class="form-control">
                </div>
                <div class="form-group col-4">

                </div>
                <div class="form-group col-1">
                    <button class="btn btn-delete-var">s</button>
                </div>
                <div class="col-12 p-4 structure-block">
                    <div class="form-row p-0 pt-1">
                        <div class="form-group col-7">
                            <input type="text" required="required" placeholder="localization.user_var"
                                   class="form-control">
                        </div>
                        <div class="form-group col-4">
                            <select class="form-control">
                                <option selected>Choossses.ы.ффs.</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-1">
                            <button class="btn btn-delete-var">s</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<div class="delimiter">
    |
</div>
<div class="text-center">
    <button class="btn btn-lg btn-save">Сохранить</button>
</div>
