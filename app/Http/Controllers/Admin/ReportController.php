<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $reports = Report::latest()->paginate(15);

        return view('admin.reports.index', compact('reports'));
    }

    public function create(): View
    {
        return view('admin.reports.create');
    }

    public function store(ReportRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('reports', 'public');
            $validated['filepath'] = $filePath;
        }

        unset($validated['file']);

        Report::create($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Rapport créé avec succès.');
    }

    public function edit(Report $report): View
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(ReportRequest $request, Report $report): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            // Delete old file
            if ($report->filepath && Storage::disk('public')->exists($report->filepath)) {
                Storage::disk('public')->delete($report->filepath);
            }

            // Store new file
            $file = $request->file('file');
            $filePath = $file->store('reports', 'public');
            $validated['filepath'] = $filePath;
        } else {
            // Keep existing file
            unset($validated['filepath']);
        }

        unset($validated['file']);

        $report->update($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Rapport mis à jour avec succès.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        // Delete file
        if ($report->filepath && Storage::disk('public')->exists($report->filepath)) {
            Storage::disk('public')->delete($report->filepath);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Rapport supprimé avec succès.');
    }
}
