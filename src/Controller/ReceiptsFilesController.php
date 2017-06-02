<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * ReceiptsFiles Controller
 *
 * @property \App\Model\Table\ReceiptsFilesTable $ReceiptsFiles
 *
 * @method \App\Model\Entity\ReceiptsFile[] paginate($object = null, array $settings = [])
 */
class ReceiptsFilesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $receiptsFiles = $this->paginate($this->ReceiptsFiles);

        $this->set(compact('receiptsFiles'));
        $this->set('_serialize', ['receiptsFiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Receipts File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receiptsFile = $this->ReceiptsFiles->get($id, [
            'contain' => []
        ]);

        $this->set('receiptsFile', $receiptsFile);
        $this->set('_serialize', ['receiptsFile']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function email($receiptType, $user, $message, $attachments = null)
    {
        $userName = explode(" ", $user['name']);
        $formatName = "";
        if(sizeof($userName) > 3){
            for($i = 0; $i < 3; $i++) {
                $formatName .= $userName[$i] . ' ';
            }
        }
        else{
            foreach ($userName as $name) {
                $formatName .= $name . ' ';
            }
        }

        if(strcmp($receiptType, '1') == 0){
            $email = new Email('default');
            $email->setFrom(['yadsondev@gmail.com' => 'CIGIG'])
            ->setTo($user['email'])
            ->setSubject('(CIGIG) - Envio de comprovante, '. $formatName .'SIAPE('. $user['registration'] .').')
            ->attachments($attachments)
            ->emailFormat('html')
            ->send($message);
        }
        else{
            $email = new Email('default');
            $email->setFrom(['yadsondev@gmail.com' => 'IFPE Campus Igarassu'])
            ->setTo($user['email'])
            ->setSubject('(CIGIG) - Envio de comprovante, '. $formatName .'SIAPE('. $user['registration'] .').')
            ->attachments($attachments)
            ->emailFormat('html')
            ->send($message);
        }
    }

    public function uploadReceiptFiles($receipt, $files)
    {
        $uploadPath = 'uploads/files/';

        $username = str_replace(" ","", $this->Auth->user('name'));

        if(strcmp($receipt['receiptType'], '1') == 0){
            if(!empty($files['name'])){
                $fileName = $username . "-" . substr($receipt['payment'], 0, 4) . ".zip";
                $uploadFile = $uploadPath.$fileName;
                if(move_uploaded_file($files['tmp_name'], WWW_ROOT . $uploadFile)){
                    $file = TableRegistry::get('Files')->newEntity();
                    $file->name = $fileName;
                    $file->src = $uploadPath;
                    TableRegistry::get('Files')->save($file);
                    return [$file->id];
                }
            }
            return false;
        }
        else{
            if(!empty($files[0]['name']) && !empty($files[1]['name'])){ 
                $date = substr(str_replace("/", "-", $receipt['payment']), 0, 7);

                $fileNameOne = $username . $date . '-1.pdf';
                $uploadFileOne = $uploadPath.$fileNameOne;

                $fileNameTwo = $username . $date . '-2.pdf';
                $uploadFileTwo = $uploadPath.$fileNameTwo;

                if(
                    move_uploaded_file($files[0]['tmp_name'], WWW_ROOT . $uploadFileOne) &&
                    move_uploaded_file($files[1]['tmp_name'], WWW_ROOT . $uploadFileTwo)
                ){
                    $fileOne = TableRegistry::get('Files')->newEntity();
                    $fileOne->name = $fileNameOne;
                    $fileOne->src = $uploadPath;
                    TableRegistry::get('Files')->save($fileOne);

                    $fileTwo = TableRegistry::get('Files')->newEntity();
                    $fileTwo->name = $fileNameTwo;
                    $fileTwo->src = $uploadPath;
                    TableRegistry::get('Files')->save($fileTwo);
                    return [$fileOne->id, $fileTwo->id];
                }
            }
            return false;
        }
    }

    public function add()
    {
        $receiptsFile = $this->ReceiptsFiles->newEntity();
        $receipt = TableRegistry::get('Receipts')->newEntity();
        TableRegistry::get('Files')->newEntity();
        $path = WWW_ROOT . 'uploads/files/';
        
        if ($this->request->is('post')) {
            if($this->request->data['plType'] === '1'){
                $receipt->receiptType = $this->request->data['plType'];
                $receipt->payment = $this->request->data['payment']['year'] . "/00/00";
                $receipt->send = date("y/m/d");
                $receipt->user_id = $this->Auth->user('id');
                $receipt->aproved = 0;

                if(TableRegistry::get('Receipts')->save($receipt)){
                    $fileId = $this->uploadReceiptFiles($receipt, $this->request->data['file']);
                    
                    $receiptsFileOne = $this->ReceiptsFiles->newEntity();
                    $receiptsFileOne->id_receipt = $receipt->id;
                    $receiptsFileOne->id_file = $fileId[0];
                    $this->ReceiptsFiles->save($receiptsFileOne);

                    $file = TableRegistry::get('Files')->get($fileId[0], [
                        'contain' => []
                    ]);

                    $message = "<h1>Hello World</h1>";

                    $this->email($receipt->receiptType, $this->Auth->user() , $message, [
                        $file->name => [
                            'file' => $path . $file->name
                        ]
                    ]);
                    $this->Flash->success(__('The receipts file has been saved.'));
                    return $this->redirect(['action' => 'add']);
                }
                else{
                    $this->Flash->error(__('The receipts file could not be saved. Please, try again.'));
                }
            }
            else{
                $receipt->receiptType = $this->request->data['plType'];
                $receipt->payment = $this->request->data['payment']['year'] . "/" . $this->request->data['payment']['month'] . "/00";
                $receipt->send = date("y/m/d");
                $receipt->user_id = $this->Auth->user('id');
                $receipt->aproved = 0;

                if(TableRegistry::get('Receipts')->save($receipt)){
                    $filesId = $this->uploadReceiptFiles($receipt, [$this->request->data['fileOne'], $this->request->data['fileTwo']]);
                    
                    $receiptsFileOne = $this->ReceiptsFiles->newEntity();
                    $receiptsFileOne->id_receipt = $receipt->id;
                    $receiptsFileOne->id_file = $filesId[0];
                    $this->ReceiptsFiles->save($receiptsFileOne);

                    $receiptsFileTwo = $this->ReceiptsFiles->newEntity();
                    $receiptsFileTwo->id_receipt = $receipt->id;
                    $receiptsFileTwo->id_file = $filesId[1];
                    $this->ReceiptsFiles->save($receiptsFileTwo);

                    $fileOne = TableRegistry::get('Files')->get($filesId[0], [
                        'contain' => []
                    ]);
                    $fileTwo = TableRegistry::get('Files')->get($filesId[1], [
                        'contain' => []
                    ]);
                    $attachments = [
                        $fileOne->name => [
                            'file' => $path . $fileOne->name,
                        ],
                        $fileTwo->name => [
                            'file' => $path . $fileTwo->name,
                        ]
                    ];
                    $message = "<h1>Hello World</h1>";

                    $this->email($receipt->receiptType, $this->Auth->user(), $message, $attachments);
                    $this->Flash->success(__('The receipts file has been saved.'));
                    return $this->redirect(['action' => 'add']);
                }
                else{
                    $this->Flash->error(__('The receipts file could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('receiptsFile'));
        $this->set('_serialize', ['receiptsFile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Receipts File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receiptsFile = $this->ReceiptsFiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $receiptsFile = $this->ReceiptsFiles->patchEntity($receiptsFile, $this->request->getData());
            if ($this->ReceiptsFiles->save($receiptsFile)) {
                $this->Flash->success(__('The receipts file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipts file could not be saved. Please, try again.'));
        }
        $this->set(compact('receiptsFile'));
        $this->set('_serialize', ['receiptsFile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Receipts File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receiptsFile = $this->ReceiptsFiles->get($id);
        if ($this->ReceiptsFiles->delete($receiptsFile)) {
            $this->Flash->success(__('The receipts file has been deleted.'));
        } else {
            $this->Flash->error(__('The receipts file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
