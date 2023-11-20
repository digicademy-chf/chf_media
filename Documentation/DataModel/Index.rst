..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

The CHF Media data model is largely just an extension of TYPO3's own metadata
table for files. The central classes are ``File``s or ``FileReferences``. The
added properties allow you to add, for example, licence information or links
to objects and volumes. Files may also be annotated via ``LabelTag``s.

In addition, ``FileCollections`` may help you structure a disparate set of
files and build a user-accessible page around it. This may be useful for sets
of files that do not represent a class present in another data model of the
CHF but that still need to be collected in a form of online exhibition.
``Agents`` can be defined as authors in several roles via the
``AuthorshipRelation`` class.

In addition, the model knows flexible ``LabelTag``s and ``SameAs`` classes,
which can be used to group files and file collections via labels and to
connect entities to authority files.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: /DataModel/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
