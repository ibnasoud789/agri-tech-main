from django.shortcuts import render, redirect
from .models import GrantProviderT
from .models import GrantProviderTargetT
from .models import GrantT
from .forms import GPForm
from .forms import GTForm
from .forms import GForm

def provider_list(request):
    context = {'provider_list' : GrantProviderT.objects.all()}
    return render(request, "provider_list.html", context)

def provider_form(request, id=0):
    if request.method=="GET":
        if id==0:
            form = GPForm()
        else:
            provider = GrantProviderT.objects.get(pk=id)
            form = GPForm(instance=provider)
        return render(request, "provider_form.html", {'form':form})
    else:
        if id==0:
            form = GPForm(request.POST)
        else:
            provider = GrantProviderT.objects.get(pk=id)
            form = GPForm(request.POST, instance=provider)
        if form.is_valid():
            form.save()
        return redirect('list')

def provider_delete(request, id):
    provider = GrantProviderT.objects.get(pk=id)
    provider.delete()
    return redirect('home')

def home(request, id=0):
    return render(request, "index.html")

def target_list(request):
    context = {'target_list' : GrantProviderTargetT.objects.all()}
    return render(request, "target_list.html", context)

def target_form(request, id=0):
    if request.method=="GET":
        if id==0:
            form = GTForm()
        else:
            target = GrantProviderTargetT.objects.get(pk=id)
            form = GTForm(instance=target)
        return render(request, "target_form.html", {'form':form})
    else:
        if id==0:
            form = GTForm(request.POST)
        else:
            target = GrantProviderTargetT.objects.get(pk=id)
            form = GTForm(request.POST, instance=target)
        if form.is_valid():
            form.save()
        return redirect('target_list')

def target_delete(request, id):
    target = GrantProviderT.objects.get(pk=id)
    target.delete()
    return redirect('target_list')

def grant_list(request):
    context = {'grant_list' : GrantT.objects.all()}
    return render(request, "grant_list.html", context)

def grant_form(request, id=0):
    if request.method=="GET":
        if id==0:
            form = GForm()
        else:
            grant = GrantT.objects.get(pk=id)
            form = GForm(instance=grant)
        return render(request, "grant_form.html", {'form':form})
    else:
        if id==0:
            form = GForm(request.POST)
        else:
            grant = GrantT.objects.get(pk=id)
            form = GForm(request.POST, instance=grant)
        if form.is_valid():
            form.save()
        return redirect('grant_list')
    
def grant_delete(request, id):
    grant = GrantT.objects.get(pk=id)
    grant.delete()
    return redirect('grant_list')