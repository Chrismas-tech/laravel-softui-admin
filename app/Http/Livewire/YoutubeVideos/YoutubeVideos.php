<?php

namespace App\Http\Livewire\YoutubeVideos;

use App\Actions\YoutubeVideos\DeleteYoutubeVideos;
use App\Models\YoutubeVideo;
use Livewire\Component;
use Livewire\WithPagination;

class YoutubeVideos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public array $selected = [];
    public bool $selectExist = false;
    public bool $confirmDeletionSelected = false;

    public array $messages = [
        'traffic.required' => 'Le champ répartition est obligatoire',
        'landing_page_selected_id.required' => 'Vous devez obligatoirement sélectionner une landing page',
    ];

    public function rules()
    {
        return [
            'traffic' => 'required|string',
            'landingPageSelected' => 'required|int',
        ];
    }

    public function mount()
    {
        /*$this->campaign = $campaign;
        $this->campaignPages = CampaignPage::where('campaign_id', $campaign->id)->get();
        $this->deleteCampaignPageModal = false;
        $this->isValid = false;
        $this->addLandingPageModal = false; */
    }

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            array_push($this->selected, $id);
        }

        if (empty($this->selected)) {
            $this->selectExist = false;
        } else {
            $this->selectExist = true;
        }
    }

    public function confirmDeletionSelected()
    {
        $this->confirmDeletionSelected = true;
    }

    public function deleteSelection()
    {
        if (DeleteYoutubeVideos::run($this->selected)) {
            session()->flash('success', 'Your videos are successfully deleted !');
            redirect()->route('admin.youtube-videos.index');
        } else {
            session()->flash('error', 'Something went wrong, please retry !');
        }
    }

    public function render()
    {
        return view('livewire.youtube-videos.youtube-videos', ['youtubeVideos' => YoutubeVideo::paginate(5)]);
    }

    public function deleteCampaignPageModal($id)
    {
        /*         $this->deleteCampaignPageModal = true;
        $this->campaignPage = CampaignPage::findOrFail($id);
        $this->titleLandingPage = $this->campaignPage->page->name;
        $this->landingPageId = $this->campaignPage->page->id; */
    }

    public function deleteCampaignPage()
    {
    }

    public function updated($propertyName)
    {
    }

    public function addLandingPageModal()
    {
        /*         $this->addLandingPageModal = true;
        $this->landingPages = Page::all(); */
    }

    public function AddLandingPageCampaign()
    {
        /*         if (CreateCampaignPage::run($this->campaign, $this->validate())) {
            session()->flash('success', 'Landing page associée avec succès !');
            redirect()->route('campaign.edit', $this->campaign->id);
        } else {
            session()->flash('error', 'Une erreur est survenue !');
        } */
    }
}
