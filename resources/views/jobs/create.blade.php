<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">

        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="$75,000 USD" />
        <x-forms.input label="Location" name="location" placeholder="Ogui Road" />
        {{-- <x-forms.input label="Description" name="description" placeholder="Job Description" /> --}}
        <x-forms.textarea label="Job Description" name="description"  placeholder="Enter detailed job description" />

        
        

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
            
        </x-forms.select>
        <x-forms.input label="URL" name="url" placeholder="https://sawo.com.ng/intern-wanted" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.divider />
        
        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="education, engineering, ict" />

        <x-forms.button>Publish</x-forms.button>
    
    
       </x-forms.form>
</x-layout>