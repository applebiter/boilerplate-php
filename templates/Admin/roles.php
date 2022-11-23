<div class="row gx-5 align-items-center justify-content-center">

    <div class="col-lg-12">
        <h2>
            <i class="bi bi-person-badge me-2"></i>
            <?= __('Roles') ?>
        </h2>
        <p class="small">
            <?= __('All user roles in the application.') ?>
        </p>
        <?= $this->Flash->render() ?>

        <div class="row gx-5">

            <div class="col-lg-6">

                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role) : ?>
                        <tr class="table-active">
                            <td><?= h($role->name) ?></th>
                            <td> 
                                <?= $this->Form->postLink(__('<i class="bi bi-trash-fill me-1" title="Click here to delete this role"></i>'), [
                                        'action' => 'role', 
                                        $role->id
                                    ],[
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete role {0}?', h($role->name)),
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
                    'url' => '/admin/role'
                ]) ?>
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    <fieldset><legend><?= __('Add a New Role') ?></legend>
                    
                        <div class="form-group">
                            <label for="path" class="col-form-label">
                                <?= __('Role Name') ?>
                            </label>
                            <input type="input" class="form-control<?= $this->Form->error('name') ? ' is-invalid' : '' ?>" 
                                id="name" name="name" required maxlength="30" autocomplete="off">
                            <?php if ($this->Form->error('name')) : ?>
                            <div class="text-danger"><?php print_r($this->Form->error('name')) ?></div>
                            <?php endif ?>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-4" onclick="this.form.submit()">
                                <?= __('Add Role') ?> 
                                <i class="bi bi-save ms-2"></i>
                            </button>
                        </div>

                    </fieldset>
                <?= $this->Form->end() ?>
                
            </div>
        </div>
    </div>
</div>

