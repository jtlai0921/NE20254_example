<?php
class rssGen extends domDocument {
  private $channel;
  private $Seq;

  function __construct($title, $link, $description) {
    parent::__construct('1.0','utf-8');
    $this->formatOutput = true;
    $root = $this->appendchild(new domElement('rdf:RDF'));
    $root->setAttribute('xmlns:rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    $root->setAttribute('xmlns','http://purl.org/rss/1.0/');
    $root->setAttribute('xmlns:dc','http://purl.org/dc/elements/1.1/');
    $this->createChannel($title, $link, $description);
  }

  function createChannel($title, $link, $description) {
    $this->channel = $this->documentElement->appendChild(new domElement('channel'));
    $this->channel->setAttribute('rdf:about',$link);
    $this->channel->appendChild(new domElement("title",$title));
    $this->channel->appendChild(new domElement("description",$description));
    $this->channel->appendChild(new domElement("link",$link));
    $items = $this->channel->appendChild(new domElement('items'));
    $this->Seq = $items->appendChild(new domElement('rdf:Seq'));
  }

  function addItem($title, $link, $description, $date) {
    $li = $this->Seq->appendChild(new domElement('rdf:li'));
    $li->setAttribute('rdf:resource',$link);
    $item = $this->documentElement->appendChild(new domElement('item'));
    $item->setAttribute('rdf:about',$link);
    $item->appendChild(new domElement('title',$title));
    $item->appendChild(new domElement('link',$link));
    $item->appendChild(new domElement('description',$description));
    $item->appendChild(new domElement('dc:date',$date));
  }
}
?>
