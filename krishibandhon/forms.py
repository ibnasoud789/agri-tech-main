from django import forms
from .models import GrantProviderT
from .models import GrantProviderTargetT
from .models import GrantT

class GPForm(forms.ModelForm):
    class Meta:
        model = GrantProviderT
        fields = '__all__'

class GTForm(forms.ModelForm):
    class Meta:
        model = GrantProviderTargetT
        fields = '__all__'

class GForm(forms.ModelForm):
    class Meta:
        model = GrantT
        fields = '__all__'