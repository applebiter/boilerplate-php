<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use  Cake\Http\Exception\NotFoundException;

/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = ['contain' => ['Users']];
        $images = $this->paginate($this->Images);
        $this->set(compact('images'));
    }
    
    /**
     * search method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function search($term = null)
    {
        $this->paginate = [
            'maxLimit' => 500,
            'limit' => 24,
            'contain' => ['Users'],
            'order' => [
                'title' => 'ASC'
            ],
        ];
        
        if (isset($_GET['term']) && !empty($_GET['term']))
        {
            $images = $this->paginate($this->Images->find('search', ['term' => $_GET['term']]));
        }
        else
        {
            $images = $this->paginate($this->Images->find('all'));
        }
        
        $this->set(compact('images'));
        $this->viewBuilder()->setOption('serialize', 'images');
    }

    /**
     * View method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $image = $this->Images->get($id, ['contain' => ['Users']]);
        $this->set(compact('image'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $image = $this->Images->newEmptyEntity();

        if ($this->request->is('post')) 
        {
            $image = $this->Images->patchEntity($image, $this->request->getData());

            if ($this->Images->save($image)) 
            {
                $this->Flash->success(__('The image has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }

        $users = $this->Images->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('image', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $image = $this->Images->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $image = $this->Images->patchEntity($image, $this->request->getData());

            if ($this->Images->save($image)) 
            {
                $this->Flash->success(__('The image has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }

        $users = $this->Images->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('image', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);

        if ($this->Images->delete($image)) 
        {
            $this->Flash->success(__('The image has been deleted.'));
        } 
        else 
        {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
    
    /**
     * show method
     *
     * @param integer|string $id
     * @return void
     */
    public function show($id = null)
    {
        $image = $this->Images->get($id);
        
        if (!$image)
        {
            throw new NotFoundException(__('Image record not found.'));
        }
        
        $file = $image->location . DS . $image->filename;
        
        if (!file_exists($file))
        {
            throw new NotFoundException(__('Image file not found.'));
        }
        
        $this->renderImage($file);
    }
    
    /**
     * renderImage method
     *
     * @param string $filepath
     */
    protected function renderImage($filepath)
    {
        $output = file_get_contents($filepath);
        $mimetypes = [
            'gif'  => 'image/gif',
            'jpg'  => 'image/jpeg',
            'png'  => 'image/png'
        ];
        
        $filename    = basename($filepath);
        $filenameArr = explode('.', $filename);
        $extension   = array_pop($filenameArr);
        
        //$response = $this->response->withFile($filepath);
        //return $response;
        
        header('Pragma: private');
        header('Cache-Control: max-age=86400');
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
        header("Content-Type: {$mimetypes[$extension]}");
        
        echo $output;
        
        exit;
    }
    
    /**
     * thumbnail method
     *
     * Renders a thumbnail of the requested image with max desired dimensions
     *
     * @param integer $id
     * @param string $dimensions
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function thumbnail($id = null, $dimensions = null)
    {
        $image = $this->Images->get($id);
        
        if (!$image)
        {
            throw new NotFoundException(__('Image record not found.'));
        }
        
        if (empty($dimensions))
        {
            throw new BadRequestException(__('Thumbnail dimensions not defined.'));
        }
        
        $file = $image->location . DS . $image->filename;
        
        $this->renderThumbnail($file, $dimensions);
    }
    
    /**
     * renderThumbnail method
     *
     * @param string $filepath
     * @param string $dimensions
     * @throws BadRequestException
     * @throws NotFoundException
     */
    protected function renderThumbnail($filepath, $dimensions)
    {
        $dimensions = strtolower($dimensions);
        $dimArr = explode('x', $dimensions);
        
        if (!isset($dimArr[0]) || empty($dimArr[0]) || !isset($dimArr[1]) || empty($dimArr[1]))
        {
            throw new BadRequestException('Thumbnail dimensions were not defined.');
        }
        
        $filename    = basename($filepath);
        $dirname     = dirname($filepath);
        $filenameArr = explode('.', $filename);
        $extension   = end($filenameArr);
        $slug        = rtrim($filename, '.' . $extension);
        $thumbdir    = $dirname . '/' . $slug;
        $thumbname   = $slug . '_' . $dimArr[0] . 'x' . $dimArr[1];
        $thumbpath   = $thumbdir . '/' . $thumbname . '.'.$extension;
        
        if (!is_dir($thumbdir))
        {
            if (!@mkdir($thumbdir, 0700, true))
            {
                return false;
            }
        }
        
        if (!file_exists($thumbpath))
        {
            if (!$this->createThumbnail($filepath, $thumbpath, $dimArr[0], $dimArr[1]))
            {
                throw new NotFoundException('Thumbnail file was not generated.');
            }
        }
        
        if (!file_exists($thumbpath))
        {
            throw new NotFoundException('Thumbnail file was not found.');
        }
        
        $output = file_get_contents($thumbpath);
        $mimetypes = [
            'gif'  => 'image/gif',
            'jpg'  => 'image/jpeg',
            'png'  => 'image/png'
        ];
        
        header('Pragma: private');
        header('Cache-Control: max-age=86400');
        header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
        header("Content-Type: {$mimetypes[$extension]}");
        
        echo $output;
        
        exit;
    }
    
    /**
     * createThumbnail method
     *
     * Creates thumbnail images from jpgs, gifs, and pngs.
     *
     * @access protected
     * @param string $src
     * @param string $dest
     * @param boolean $maxWidth
     * @param boolean $maxHeight
     * @return boolean
     */
    protected function createThumbnail($src, $dest, $maxWidth = false, $maxHeight = false)
    {
        /* If no dimenstion for thumbnail given, return false */
        if (!$maxHeight && !$maxWidth)
        {
            return false;
        }
        
        $fparts = pathinfo($src);
        $ext = strtolower($fparts['extension']);
        
        /* read the source image */
        if ($ext == 'gif')
        {
            $resource = imagecreatefromgif($src);
        }
        else if ($ext == 'png')
        {
            $resource = imagecreatefrompng($src);
        }
        else if ($ext == 'jpg')
        {
            $resource = imagecreatefromjpeg($src);
        }
        
        $width = imagesx($resource);
        $height = imagesy($resource);
        
        $x_ratio = $maxWidth / $width;
        $y_ratio = $maxHeight / $height;
        
        if (($width <= $maxWidth) && ($height <= $maxHeight))
        {
            $thumb_w = $width;
            $thumb_h = $height;
        }
        elseif ( $y_ratio <= $x_ratio )
        {
            $thumb_w = round($width * $y_ratio);
            $thumb_h = round($height * $y_ratio);
        }
        else
        {
            $thumb_w = round($width * $x_ratio);
            $thumb_h = round($height * $x_ratio);
        }
        
        /* create a new, “virtual” image */
        $virtualImage = imagecreatetruecolor(intval($thumb_w), intval($thumb_h));
        
        switch ($ext)
        {
            case "png":
                
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($virtualImage, 0, 0, 0);
                
                // removing the black from the placeholder
                imagecolortransparent($virtualImage, $background);
                
                // turning off alpha blending (to ensure alpha channel information
                // is preserved, rather than removed (blending with the rest of the
                // image in the form of black))
                imagealphablending($virtualImage, false);
                
                // turning on alpha channel information saving (to ensure the full range
                // of transparency is preserved)
                imagesavealpha($virtualImage, true);
                
                break;
                
            case "gif":
                
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($virtualImage, 0, 0, 0);
                
                // removing the black from the placeholder
                imagecolortransparent($virtualImage, $background);
                
                break;
        }
        
        /* copy source image at a resized size */
        imagecopyresampled($virtualImage, $resource, 0, 0, 0, 0, intval($thumb_w), intval($thumb_h), intval($width), intval($height));
        
        /* create the physical thumbnail image to its destination */
        /* Use correct function based on the desired image type from $dest thumbnail
         * source */
        $fparts = pathinfo($dest);
        $ext = strtolower($fparts['extension']);
        
        $dest = $fparts['dirname'] . '/' . $fparts['filename'] . '.' . $ext;
        
        if ($ext == 'gif')
        {
            imagegif($virtualImage, $dest);
        }
        else if ($ext == 'png')
        {
            imagepng($virtualImage, $dest, 1);
        }
        else if ($ext == 'jpg')
        {
            imagejpeg($virtualImage, $dest, 100);
        }
        
        return true;
    }
}
