<?php

namespace App\Filament\Pages;

use App\Models\Widget;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Filament\Forms\Components\EmojiOnlyInput;
use App\Filament\Widgets\SeafarerRanksChart;
use App\Filament\Widgets\SeafarerStatsWidget;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Storage;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $slug = '';

    public $widgets = [];
    public $editingWidgetId = null;

    public $editingWidget = null;
    public $showEditModal = false;

    // Form properties with renamed variables
    public $formTitle;
    public $formUrl;
    public $formIcon;
    public $formBackgroundColor;
    public $formBorderColor;
    public $formImagePath;
    public $formHasCredentials;
    public $formUsername;
    public $formPassword;

    protected function rules()
    {
        return [
            'formTitle' => 'required',
            'formUrl' => 'required|url',
            'formIcon' => 'required',
            'formBackgroundColor' => 'nullable',
            'formBorderColor' => 'nullable',
            'formImagePath' => 'nullable',
            'formHasCredentials' => 'boolean',
            'formUsername' => 'nullable',
            'formPassword' => 'nullable',
        ];
    }

    public function editWidget($widgetId)
    {
        try {
            $widget = Widget::where('id', $widgetId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $this->editingWidgetId = $widget->id;

            // Set form values
            $this->formTitle = $widget->title;
            $this->formUrl = $widget->url;
            $this->formIcon = $widget->icon;
            $this->formBackgroundColor = $widget->background_color;
            $this->formBorderColor = $widget->border_color;
            $this->formImagePath = $widget->image_path;
            $this->formHasCredentials = $widget->has_credentials;
            $this->formUsername = $widget->username;

            $this->showEditModal = true;
        } catch (\Exception $e) {
            Notification::make()
                ->title('Widget not found')
                ->danger()
                ->send();
        }
    }

    public function updateWidget()
    {
        $this->validate();

        try {
            $widget = Widget::where('id', $this->editingWidgetId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $data = [
                'title' => $this->formTitle,
                'url' => $this->formUrl,
                'icon' => $this->formIcon,
                'background_color' => $this->formBackgroundColor,
                'border_color' => $this->formBorderColor,
                'image_path' => $this->formImagePath,
                'has_credentials' => $this->formHasCredentials,
                'username' => $this->formUsername,
            ];

            // Only update password if a new one is provided
            if ($this->formPassword) {
                $data['password'] = $this->formPassword;
            }

            $widget->update($data);

            $this->loadWidgets();
            $this->resetForm();

            $this->dispatch('widget-updated', widgetId: $widget->id);

            Notification::make()
                ->title('Widget updated successfully')
                ->success()
                ->send();

            return redirect()->to($this->getUrl());
        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to update widget')
                ->danger()
                ->send();

            return redirect()->to($this->getUrl());
        }
    }

    public function resetForm()
    {
        $this->editingWidgetId = null;
        $this->showEditModal = false;
        $this->formTitle = '';
        $this->formUrl = '';
        $this->formIcon = '';
        $this->formBackgroundColor = '';
        $this->formBorderColor = '';
        $this->formImagePath = '';
        $this->formHasCredentials = false;
        $this->formUsername = '';
        $this->formPassword = '';
    }

    public function mount()
    {
        $this->loadWidgets();
    }

    public function loadWidgets()
    {
        $this->widgets = Auth::user()->widgets()->get()->toArray();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addWidget')
                ->label('Add Widget')
                ->color('primary')
                ->icon('heroicon-o-plus')
                ->form([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->label('Title'),
                            TextInput::make('url')
                                ->url()
                                ->required()
                                ->label('URL'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            ColorPicker::make('background_color')
                                ->label('Background Color')
                                ->hex(),
                            ColorPicker::make('border_color')
                                ->label('Border Color')
                                ->hex(),
                        ]),
                    Grid::make(2)
                        ->schema([
                            EmojiOnlyInput::make('icon')
                                ->label('Icon')
                                ->required()
                                ->columnSpan(1),
                            FileUpload::make('image_path')
                                ->label('Image')
                                ->image()
                                ->directory('widgets')
                                ->visibility('public')
                                ->acceptedFileTypes(['image/*'])
                                ->columnSpan(1),
                        ]),
                    Checkbox::make('has_credentials')
                        ->label('Has Credentials')
                        ->reactive()
                        ->columnSpanFull(),
                    Grid::make(2)
                        ->schema([
                            TextInput::make('username')
                                ->label('Username'),
                            TextInput::make('password')
                                ->label('Password')
                                ->password(),
                        ])
                        ->hidden(fn($get) => !$get('has_credentials'))
                        ->reactive(),
                ])
                ->action(function (array $data): void {
                    $this->addWidget($data);
                }),
        ];
    }

    public function addWidget(array $data)
    {
        $widgetData = [
            'title' => $data['title'],
            'url' => $data['url'],
            'has_credentials' => $data['has_credentials'] ?? false,
            'user_id' => Auth::id(),
            'position_x' => 0,
            'position_y' => 0,
            'width' => 6,
            'height' => 2,
            'icon' => $data['icon'] ?? '🚀',
            'background_color' => $data['background_color'] ?? null,
            'border_color' => $data['border_color'] ?? null,
        ];

        if (!empty($data['image_path'])) {
            $widgetData['image_path'] = $data['image_path'];
        }

        if ($widgetData['has_credentials']) {
            $widgetData['username'] = $data['username'];
            $widgetData['password'] = $data['password'];
        }

        $widget = Widget::create($widgetData);

        $this->loadWidgets();

        Notification::make()
            ->title('Widget added successfully')
            ->success()
            ->send();

        $this->dispatch('widget-created', widgetId: $widget->id);

        return redirect()->to($this->getUrl());
    }

    #[On('update-widget-position')]
    public function updateWidgetPosition($widgetId, $x, $y, $width, $height)
    {
        $widget = Widget::find($widgetId);
        if ($widget && $widget->user_id === Auth::id()) {
            $widget->update([
                'position_x' => max(0, $x),
                'position_y' => max(0, $y),
                'width' => max(1, $width),
                'height' => max(1, $height),
            ]);
        }
    }

    public function removeWidget($widgetId)
    {
        $widget = Widget::find($widgetId);
        if ($widget && $widget->user_id === Auth::id()) {
            $widget->delete();
            $this->loadWidgets();

            Notification::make()
                ->title('Widget removed successfully')
                ->success()
                ->send();
        }
    }

    public function getViewData(): array
    {
        return [
            'widgets' => $this->widgets,
        ];
    }

    public function removeImage()
    {
        if ($this->editingWidget && $this->editingWidget->image_path) {
            Storage::disk('public')->delete($this->editingWidget->image_path);
            $this->editingWidget->update(['image_path' => null]);
            $this->formImagePath = null;
        }
    }

    protected function getFooterWidgets(): array
    {
        return [
            // SeafarerRanksChart::class,
            // SeafarerStatsWidget::class,
        ];
    }

    public function getFooterWidgetsColumns(): int|array
    {
        return 12;
    }
}
