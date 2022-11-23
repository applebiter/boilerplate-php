<div class="row gx-5 align-items-center justify-content-center">

    <div class="col-lg-12">
        <h2>
            <i class="bi bi-pin-map-fill me-2"></i>
            <?= __('Endpoints') ?>
        </h2>
        <p class="small">
            <?= __('All application resources requiring authorization to access or manipulate.') ?>
        </p>
        <?= $this->Flash->render() ?>

        <div class="row gx-5">

            <div class="col-lg-6">

                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Type') ?></th>
                            <th scope="col"><?= __('Path') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resources as $resource) : ?>
                        <tr class="table-active">
                            <td><?= h($resource->type) ?></th>
                            <td><?= h($resource->path) ?></td>
                            <td> 
                                <a href="/admin/permissions/<?= h($resource->id) ?>" title="Click here to manage permissions for this resource">
                                    <i class="bi bi-file-lock2 me-1"></i></a> &nbsp; 
                                <?= $this->Form->postLink(__('<i class="bi bi-trash-fill me-1" title="Click here to delete this resource"></i>'), [
                                        'action' => '/resource', 
                                        $resource->id
                                    ],[
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete endpoint {0}?', h($resource->path)),
                                        'escape' => false
                                    ]) ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>

            <div class="col-lg-6">

                <?= $this->Form->create($form, [
                    'autocomplete' => 'off',
                    'class' => 'g-3 mt-4',
                    'url' => '/admin/resource'
                ]) ?>
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    <fieldset><legend><?= __('Add a New Resource') ?></legend>
                    
                        <div class="form-group">
                            <label for="path" class="col-form-label">
                                <?= __('Resource Path') ?>
                            </label>
                            <input type="input" class="form-control<?= $this->Form->error('path') ? ' is-invalid' : '' ?>" 
                                id="path" name="path" required maxlength="128" autocomplete="off">
                            <?php if ($this->Form->error('path')) : ?>
                            <div class="text-danger"><?php print_r($this->Form->error('path')) ?></div>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="type" class="form-label mt-4">
                                <?= __('Resource Type') ?>
                            </label>
                            <select class="form-select" id="type" name="type">
                                <option value=""><?= __('Choose...') ?></option>
                                <option value="URI"><?= __('URI') ?></option>
                                <option value="FILE"><?= __('File') ?></option>
                                <option value="ENTITY"><?= __('Entity') ?></option>
                                <option value="TABLE"><?= __('Table') ?></option>
                                <option value="SERVICE"><?= __('Service') ?></option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-4" onclick="this.form.submit()">
                                <?= __('Add Endpoint') ?> 
                                <i class="bi bi-save ms-2"></i>
                            </button>
                        </div>

                    </fieldset>
                <?= $this->Form->end() ?>
                
            </div>
        </div>
    </div>
</div>

